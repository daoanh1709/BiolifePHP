function showModalError(message) {
    $('#modalDanger .panel-body .modal-wrapper .modal-text p').html(message);
    $('#showModal').click();
}

function showModalSuccess(message) {
    $('#modalDanger').removeClass('modal-block-danger');
    $('#modalDanger').addClass('modal-block-success');
    $('#modalDanger .panel-heading .panel-title').html("Success!");
    $('#modalDanger .panel-body .modal-wrapper .modal-text p').html(message);
    $('#modalDanger .panel-body .modal-wrapper .modal-icon i').removeClass('fa-times-circle');
    $('#modalDanger .panel-body .modal-wrapper .modal-icon i').addClass('fa-check');
    $('#submit').removeClass('btn-danger');
    $('#submit').addClass('btn-success');
    $('#showModal').click();
}

(function ($) {

    'use strict';
    var EditableTable = {

        options: {
            addButton: '#addToTable',
            table: '#datatable-editable',
            dialog: {
                wrapper: '#dialog',
                cancelButton: '#dialogCancel',
                confirmButton: '#dialogConfirm',
            }
        },

        initialize: function () {
            this
                    .setVars()
                    .build()
                    .events();
        },

        setVars: function () {
            this.$table = $(this.options.table);
            this.$addButton = $(this.options.addButton);

            // dialog
            this.dialog = {};
            this.dialog.$wrapper = $(this.options.dialog.wrapper);
            this.dialog.$cancel = $(this.options.dialog.cancelButton);
            this.dialog.$confirm = $(this.options.dialog.confirmButton);

            return this;
        },

        build: function () {
            this.datatable = this.$table.DataTable();

            window.dt = this.datatable;

            return this;
        },

        events: function () {
            var _self = this;

            this.$table
                    .on('click', 'a.save-row', function (e) {
                        e.preventDefault();
                        var valid = true;
                        var $row = $(this).closest('tr');
                        var id = $row.attr('id');
                        var discountStr = $row.find('#dealDiscount').val();
                        var discount = parseFloat(discountStr);
                        if (isNaN(discount)) {
                            showModalError("Discount must be a real number from 0.0 to 1.0");
                            valid = false;
                        } else {
                            if (discount > 1 || discount < 0) {
                                showModalError("Discount must be a real number from 0.0 to 1.0");
                                valid = false;
                            }
                        }

                        var start = $row.find('#dealStart').val();
                        var end = $row.find('#dealEnd').val();
                        var dealStart = new Date(start);
                        var dealEnd = new Date(end);
                        if (dealEnd < dealStart) {
                            showModalError("Start date must be earlier than End date");
                            valid = false;
                        }
                        _self.rowSave($row, start, end, discount, valid, id);
                    })
                    .on('click', 'a.cancel-row', function (e) {
                        e.preventDefault();

                        _self.rowCancel($(this).closest('tr'));
                    })
                    .on('click', 'a.edit-row', function (e) {
                        e.preventDefault();

                        _self.rowEdit($(this).closest('tr'));
                    })
                    .on('click', 'a.remove-row', function (e) {
                        e.preventDefault();

                        var $row = $(this).closest('tr');

                        $.magnificPopup.open({
                            items: {
                                src: '#dialog',
                                type: 'inline'
                            },
                            preloader: false,
                            modal: true,
                            callbacks: {
                                change: function () {
                                    _self.dialog.$confirm.on('click', function (e) {
                                        e.preventDefault();

                                        _self.rowRemove($row);
                                        $.magnificPopup.close();
                                    });
                                },
                                close: function () {
                                    _self.dialog.$confirm.off('click');
                                }
                            }
                        });
                    });

            this.$addButton.on('click', function (e) {
                e.preventDefault();

                _self.rowAdd();
            });

            this.dialog.$cancel.on('click', function (e) {
                e.preventDefault();
                $.magnificPopup.close();
            });

            return this;
        },

        // ==========================================================================================
        // ROW FUNCTIONS
        // ==========================================================================================
        rowAdd: function () {
            this.$addButton.attr({'disabled': 'disabled'});

            var actions,
                    data,
                    $row;

            actions = [
                '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>',
                '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>',
                '<a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>',
                '<a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>'
            ].join(' ');

            data = this.datatable.row.add(['', '', '', actions]);
            $row = this.datatable.row(data[0]).nodes().to$();

            $row
                    .addClass('adding')
                    .find('td:last')
                    .addClass('actions');

            this.rowEdit($row);

            this.datatable.order([0, 'asc']).draw(); // always show fields
        },

        rowCancel: function ($row) {
            var _self = this,
                    $actions,
                    i,
                    data;
            $row.children('td').each(function (i) {
                var $this = $(this);
                var id = $this.find('input').attr('id');
                $this.attr('id', id);
            });
            if ($row.hasClass('adding')) {
                this.rowRemove($row);
            } else {

                data = this.datatable.row($row.get(0)).data();
                this.datatable.row($row.get(0)).data(data);

                $actions = $row.find('td.actions');
                if ($actions.get(0)) {
                    this.rowSetActionsDefault($row);
                }

                this.datatable.draw();
            }
        },

        rowEdit: function ($row) {
            var _self = this,
                    data;

            data = this.datatable.row($row.get(0)).data();

            $row.children('td').each(function (i) {
                var $this = $(this);
                var id = $this.attr('id');

                if ($this.hasClass('actions')) {
                    _self.rowSetActionsEditing($row);
                } else if (id == "dealDiscount" || id == "dealStart" || id == "dealEnd") {
                    $this.html('<input type="text" class="form-control input-block" id="' + id + '" value="' + data[i] + '"/>');
                    $this.removeAttr('id');
                } else {
                    $this.html('<input type="text" class="form-control input-block" readonly id="' + id + '" value="' + data[i] + '"/>');
                    $this.removeAttr('id');
                }
            });
        },

        rowSave: function ($row, start, end, discount, valid, proid) {
            if (valid == false) {
                var _self = this,
                        $actions,
                        i,
                        data;
                $row.children('td').each(function (i) {
                    var $this = $(this);
                    var id = $this.find('input').attr('id');
                    $this.attr('id', id);
                });
                if ($row.hasClass('adding')) {
                    this.rowRemove($row);
                } else {

                    data = this.datatable.row($row.get(0)).data();
                    this.datatable.row($row.get(0)).data(data);

                    $actions = $row.find('td.actions');
                    if ($actions.get(0)) {
                        this.rowSetActionsDefault($row);
                    }

                    this.datatable.draw();
                }
            } else {
                var _self = this,
                        $actions,
                        values = [];

                if ($row.hasClass('adding')) {
                    this.$addButton.removeAttr('disabled');
                    $row.removeClass('adding');
                }
                $row.children('td').each(function (i) {
                    var $this = $(this);
                    var id = $this.find('input').attr('id');
                    $this.attr('id', id);
                });
                values = $row.find('td').map(function () {
                    var $this = $(this);
                    if ($this.hasClass('actions')) {
                        _self.rowSetActionsDefault($row);
                        return _self.datatable.cell(this).data();
                    } else {
                        $.ajax({
                            type: 'get',
                            url: 'http://localhost:1000/Biolife/admin/process/deal_process.php',
                            data: {
                                action: "save",
                                id: proid,
                                startDeal: start,
                                endDeal: end,
                                discount: discount
                            },
                            success: function (response) {
                                if (response == "Success") {
                                    showModalSuccess("This deal has been updated successfully.");
                                }
                            }
                        });
                        return $.trim($this.find('input').val());
                    }
                });

                this.datatable.row($row.get(0)).data(values);

                $actions = $row.find('td.actions');
                if ($actions.get(0)) {
                    this.rowSetActionsDefault($row);
                }

                this.datatable.draw();
            }
        },

        rowRemove: function ($row) {
            if ($row.hasClass('adding')) {
                this.$addButton.removeAttr('disabled');
            }

            this.datatable.row($row.get(0)).remove().draw();
        },

        rowSetActionsEditing: function ($row) {
            $row.find('.on-editing').removeClass('hidden');
            $row.find('.on-default').addClass('hidden');
        },

        rowSetActionsDefault: function ($row) {
            $row.find('.on-editing').addClass('hidden');
            $row.find('.on-default').removeClass('hidden');
        }

    };

    $(function () {
        EditableTable.initialize();
    });

}).apply(this, [jQuery]);