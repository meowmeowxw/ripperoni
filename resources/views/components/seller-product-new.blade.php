<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{__('Add Beer')}}</h4>
        <button {{ $attributes->merge([
                'class' => 'btn btn-primary',
                'type' => 'button',
                'data-toggle' => 'collapse',
                'data-target' => '#collapse_add',
                'aria-expanded' => 'false',
                'aria-controls' => 'collapseButton'
                ]) }}>
            {{__('Add')}}
        </button>
        <div {{ $attributes->merge(['class' => 'collapse', 'id' => 'collapse_add']) }}>
            <div class="card card-body">
                <form method="POST" action="{{route('seller.product.add')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" @error('name') is-invalid @enderror name="name" value=""/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" @error('description') is-invalid @enderror name="description" value=""/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                        <div class="col-md-6">
                            <input id="price" type="text" class="form-control" @error('price') is-invalid @enderror name="price" value=""/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
                        <div class="col-md-6">
                            <input id="quantity" type="text" class="form-control" @error('quantity') is-invalid @enderror name="quantity" value=""/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Select Image') }}</label>
                        <div class="col-md-6">
                            <input id="logo" type="file" class="form-control-file" @error('logo') is-invalid @enderror name="logo" value=""/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category">
                            <?php
                            $categories = \App\Models\Category::all();
                            ?>
                            @foreach ($categories as $category)
                                <option>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
