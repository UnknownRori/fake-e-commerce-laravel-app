<x-dashboard>
    <x-slot name="title">{{ !isset($product) ? "Create Product" : "Edit Product " . $product->title }}</x-slot>

    <x-slot name="content">
        <form class="bg-light" style="border: 0.1px solid gray; padding: 2rem; box-shadow: 2px 2px 2px 2px gray;"
         action="{{ isset($product) ? route("CreateProduct") : route("CreateProduct") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input class="form-control" type="text" name="productname" placeholder="Product Name"
                value="{{ isset($product) ? $product->productname : "" }}">
            </div>
            <div class="form-group">
                <input class="form-control" type="file" name="photo" placeholder="Product Name">
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="stock" placeholder="Starting Stock"
                value="{{ isset($product) ? $product->stock : "" }}">
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="price" placeholder="Product Price"
                value="{{ isset($product) ? $product->price : "" }}">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Product Description">{{ isset($product) ? $product->description : "" }}</textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-info" type="submit" value="Create">
            </div>
        </form>
    </x-slot>
</x-dashboard>
