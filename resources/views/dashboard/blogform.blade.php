<x-dashboard>
    <x-slot name="title">{{ !isset($blog) ? "Create Blog" : "Edit Blog " . $blog->title }}</x-slot>

    <x-slot name="content">
        <form class="form-center bg-light" style="border: 0.1px solid gray; padding: 2rem; box-shadow: 2px 2px 2px 2px gray;"
         action="{{ route("CreateBlog") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input class="form-control" type="text" name="productname" placeholder="Product Name">
            </div>
            <div class="form-group">
                <input class="form-control" type="file" name="Photo" placeholder="Product Name">
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="stock" placeholder="Starting Stock">
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="price" placeholder="Product Price">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Product Description"></textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-info" type="submit" value="Create">
            </div>
        </form>
    </x-slot>
</x-dashboard>
