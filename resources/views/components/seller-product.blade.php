<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
        <img {{ $attributes->merge(['src' => $path, 'class' => 'card-img-top', 'alt' => '']) }} />
        <button {{ $attributes->merge([
                'class' => 'btn btn-primary',
                'type' => 'button',
                'data-toggle' => 'collapse',
                'data-target' => '#collapse'.$id,
                'aria-expanded' => 'false',
                'aria-controls' => 'collapseButton'
                ]) }}>
            {{__('Edit')}}
        </button>
        <a {{ $attributes->merge(['href' => route('seller.products', $id), 'class' => 'btn btn-primary']) }}> Delete </a>
        <label>Quantity: {{ $slot }}</label>
        {{--
        'name',
        'description',
        'price',
        'quantity',
        'path',
        --}}
        <div {{ $attributes->merge(['class' => 'collapse', 'id' => 'collapse'.$id]) }}>
            <div class="card card-body">
                <form method="POST" action="{{route('seller.product.edit')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" @error('name') is-invalid @enderror name="name" value="{{$name}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" @error('description') is-invalid @enderror name="description" value="{{$description}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                        <div class="col-md-6">
                            <input id="price" type="text" class="form-control" @error('price') is-invalid @enderror name="price" value="{{$price}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
                        <div class="col-md-6">
                            <input id="quantity" type="text" class="form-control" @error('quantity') is-invalid @enderror name="quantity" value="{{$quantity}}"/>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                    <input {{ $attributes->merge(['id' => 'product_id', 'name' => 'id', 'type' => 'hidden', 'value' => $id]) }} />
                </form>
            </div>

        </div>
    </div>
</div>
