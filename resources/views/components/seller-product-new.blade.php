<div class="card m-2">
        {{--
        <h4 class="card-title">{{__('Add Beer')}}</h4>
        --}}

        <button {{ $attributes->merge([
                'class' => 'btn btn-primary',
                'type' => 'button',
                'data-toggle' => 'collapse',
                'data-target' => '#collapse_add',
                'aria-expanded' => 'false',
                'aria-controls' => 'collapseButton'
                ]) }}>
            {{__('Add Beer')}}
        </button>
        <div {{ $attributes->merge(['class' => 'collapse', 'id' => 'collapse_add']) }}>
            <div class="card card-body">
                <form method="POST" action="{{route('seller.product.add')}}" enctype="multipart/form-data">
                    @csrf

                    <x-FormInput name="name" idAndFor="nameNew" :lblName="__('Name')" type="text"/>
                    <x-FormInput name="description" idAndFor="descriptionNew" :lblName="__('Description')" type="text"/>
                    <x-FormInput name="price" idAndFor="priceNew" :lblName="__('Price')" type="number"/>
                    <x-FormInput name="quantity" idAndFor="quantityNew" :lblName="__('Quantity')" type="number"/>

                    <x-form.form-category name="category" idAndFor="category" lblValue="Category" />

                    <x-form.form-img name="logo" idAndFor="logoNew" lblValue="{{ __('Select Image') }}" />

                    <div class="form-group row mb-0 justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                    </div>
                </form>
            </div>
        </div>
</div>
