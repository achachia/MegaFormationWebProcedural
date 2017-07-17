<!-- Include Bootstrap Material Design files -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.2.1/css/material.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.2.1/js/material.min.js"></script>

<style type="text/css">
#productForm .availabilityContainer .form-control-feedback {
    right: 15px;
}
</style>

<form id="productForm">
    <div class="form-group">
        <label>Product name</label>
        <input type="text" class="form-control" name="name" />
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="5"></textarea>
    </div>

    <div class="form-group">
        <label>Price</label>
        <div class="input-group">
            <div class="input-group-addon">$</div>
            <input type="text" class="form-control" name="price" />
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-xs-4">
                <label>Size</label>
                <div class="checkbox">
                    <label><input type="checkbox" name="size[]" value="s" /> S</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="size[]" value="m" /> M</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="size[]" value="l" /> L</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="size[]" value="xl" /> XL</label>
                </div>
            </div>

            <div class="col-xs-4">
                <label>Color</label>
                <div class="checkbox">
                    <label><input type="checkbox" name="color[]" value="white" /> White</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="color[]" value="black" /> Black</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="color[]" value="yellow" /> Yellow</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="color[]" value="green" /> Green</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="color[]" value="red" /> Red</label>
                </div>
            </div>

            <div class="col-xs-4 availabilityContainer">
                <label>Available in store</label>
                <div class="radio">
                    <label><input type="radio" name="availability" value="yes" /> Yes</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="availability" value="no" /> No</label>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Add product</button>
</form>

<script>
$(document).ready(function() {
    $('#productForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The name must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'The username can only consist of alphabetical, number and underscore'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'The description is required'
                    },
                    stringLength: {
                        min: 50,
                        max: 1000,
                        message: 'The description must be more than 50 and less than 1000 characters'
                    }
                }
            },
            price: {
                validators: {
                    notEmpty: {
                        message: 'The price is required'
                    },
                    numeric: {
                        message: 'The price must be a number'
                    }
                }
            },
            'size[]': {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The size is required'
                    }
                }
            },
            'color[]': {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The color is required'
                    }
                }
            },
            availability: {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The availability option is required'
                    }
                }
            }
        }
    });

    // By calling Bootstrap Material Design after calling .formValidation()
    // you don't need to adjust the position of feedback icons
    $.material.init();
});
</script>