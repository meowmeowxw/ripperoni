<div class="card m-1">
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
        <form id="delete" method="POST" action="{{route('seller.product.delete')}}">
            @csrf
            <button type="submit" class="btn btn-primary">
                {{ __('Delete') }}
            </button>
            <input {{ $attributes->merge([
                            'id' => 'product_id_delete',
                            'name' => 'id',
                            'type' => 'hidden',
                            'value' => $id
                            ]) }} />
        </form>
        </a>
        <div {{ $attributes->merge(['class' => 'collapse', 'id' => 'collapse'.$id]) }}>
            <div class="card card-body justify-content-center m-1">
                <form method="POST" action="{{route('seller.product.edit')}}">
                    @csrf

                    <x-FormInput name="name" idAndFor="name{{$id}}" :lblName="__('Name')" :inputValue="$name" type="text" />
                    <x-FormInput name="description" idAndFor="description{{$id}}" :lblName="__('Description')" :inputValue="$description" type="text" />
                    <x-FormInput name="price" idAndFor="price{{$id}}" :lblName="__('Price')" :inputValue="$price" type="number" />
                    <x-FormInput name="quantity" idAndFor="quantity{{$id}}" :lblName="__('Quantity')" :inputValue="$quantity" type="number" />

                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                        {{ __('Save') }}
                    </button>

                    <input {{ $attributes->merge([
                            'id' => 'product_id',
                            'name' => 'id',
                            'type' => 'hidden',
                            'value' => $id
                            ]) }} />
                </form>
            </div>
        </div>
    </div>
</div>
