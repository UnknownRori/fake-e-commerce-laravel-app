<x-dashboard>
    <x-slot name="title">{{ !isset($blog) ? "Create Blog" : "Edit Blog " . $blog->title }}</x-slot>

    <x-slot name="content">
        <form class="bg-light" style="border: 0.1px solid gray; padding: 2rem; box-shadow: 2px 2px 2px 2px gray;"
         action="{{ isset($blog) ? route("EditBlog", $blog->id) : route("CreateBlog") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input class="form-control" type="text" name="title" placeholder="Blog Title"
                value="{{ isset($blog) ? $blog->title : "" }}">
            </div>
            <div class="form-group">
                <input class="form-control" type="file" name="photo" placeholder="Blog Photo">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" id="" cols="30" rows="10" placeholder="Blog Content">{{ isset($blog) ? $blog->content : "" }}</textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-info" type="submit" value="{{ isset($blog) ? "Edit" : "Create" }}">
            </div>
        </form>
    </x-slot>
</x-dashboard>
