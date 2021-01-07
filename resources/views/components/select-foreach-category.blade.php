<select class="form-control" id="category" name="category">
    <?php
    $categories = \App\Models\Category::all();
    ?>
    @foreach ($categories as $category)
    <option>{{$category->name}}</option>
    @endforeach
</select>
