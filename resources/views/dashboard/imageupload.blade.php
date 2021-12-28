<x-dashboard>
    <x-slot name="title">Upload Image</x-slot>

    <x-slot name="content">
        <form class="bg-light" style="border: 0.1px solid gray; padding: 2rem; box-shadow: 2px 2px 2px 2px gray;"
         action="{{ route("UploadImage") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <select name="path" id="" class="form-control" title="Upload file path">
                    <option value="product">Product</option>
                    <option value="blog">Blog</option>
                    <option value="profile">Profile</option>
                </select>
            </div>
            <div class="form-group">
                <input class="form-control" type="file" name="image" placeholder="Blog Photo">
            </div>
            <div class="form-group">
                <input class="btn btn-info" type="submit" value="Upload">
            </div>
        </form>
    </x-slot>
</x-dashboard>
