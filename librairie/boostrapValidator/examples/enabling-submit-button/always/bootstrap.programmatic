<form id="alwaysEnableButtonForm" method="post" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">Task</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="task" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Description</label>
        <div class="col-xs-5">
            <textarea class="form-control" name="description" rows="5"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Priority</label>
        <div class="col-xs-5">
            <select class="form-control" name="priority" style="width: 200px;">
                <option value="">Choose the priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-5 col-xs-offset-3">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    $('#alwaysEnableButtonForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                task: {
                    validators: {
                        notEmpty: {
                            message: 'The task is required'
                        }
                    }
                },
                description: {
                    validators: {
                        notEmpty: {
                            message: 'The description is required'
                        }
                    }
                },
                priority: {
                    validators: {
                        notEmpty: {
                            message: 'The priority is required'
                        }
                    }
                }
            }
        })
        .on('err.field.fv', function(e, data) {
            // $(e.target)  --> The field element
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            data.fv.disableSubmitButtons(false);
        })
        .on('success.field.fv', function(e, data) {
            // e, data parameters are the same as in err.field.fv event handler
            // Despite that the field is valid, by default, the submit button will be disabled if all the following conditions meet
            // - The submit button is clicked
            // - The form is invalid
            data.fv.disableSubmitButtons(false);
        });
});
</script>