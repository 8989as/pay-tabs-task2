<!DOCTYPE html>
<html>
<head>
    <title>Category Selector</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Select Categories</h2>
    <div id="category-select-boxes">
        <div class="form-group">
            <label for="main-category">Main Category:</label>
            <select id="main-category" class="form-control" onchange="loadSubcategories(this)">
                <option value="">Select Main Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<script>
    function loadSubcategories(selectElement) {
        var categoryId = $(selectElement).val();
        var selectBoxContainer = $('#category-select-boxes');

        // Remove all select boxes that are below the current level
        $(selectElement).parent().nextAll().remove();

        if (categoryId) {
            $.ajax({
                url: '/categories/' + categoryId + '/subcategories',
                type: 'GET',
                success: function (subcategories) {
                    if (subcategories.length > 0) {
                        var subcategorySelectBox = '<div class="form-group">' +
                            '<label for="subcategory-' + categoryId + '">Subcategory:</label>' +
                            '<select id="subcategory-' + categoryId + '" class="form-control" onchange="loadSubcategories(this)">' +
                            '<option value="">Select Subcategory</option>';

                        $.each(subcategories, function (index, subcategory) {
                            subcategorySelectBox += '<option value="' + subcategory.id + '">' + subcategory.name + '</option>';
                        });

                        subcategorySelectBox += '</select></div>';

                        selectBoxContainer.append(subcategorySelectBox);
                    }
                }
            });
        }
    }
</script>
</body>
</html>
