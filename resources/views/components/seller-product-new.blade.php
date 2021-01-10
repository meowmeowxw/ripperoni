<div class="card m-2">
    {{--
    <h4 class="card-title">{{__('Add Beer')}}</h4>
    --}}
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse_add"
            aria-expanded="false" aria-controls="collapseButton">
        {{__('Add Beer')}}
    </button>

    <div {{ $attributes->merge(['class' => 'collapse', 'id' => 'collapse_add']) }}>
        <div class="card card-body">
            <x-form.form action="{{route('seller.product.add')}}" enctype="multipart/form-data"
                         btntext="{{ __('Save') }}" btnaddclass="btn-lg btn-block">

                <x-FormInput name="name" idAndFor="nameNew" :lblName="__('Name')" type="text"/>
                <x-FormInput name="description" idAndFor="descriptionNew" :lblName="__('Description')" type="text"/>
                <x-FormInput name="price" idAndFor="priceNew" :lblName="__('Price')" type="number"/>
                <x-FormInput name="quantity" idAndFor="quantityNew" :lblName="__('Quantity')" type="number"/>

                <x-form.form-category name="category" idAndFor="category" lblValue="Category"/>

                <x-form.form-img name="logo" idAndFor="logoNew" lblValue="{{ __('Select Image') }}"/>
            </x-form.form>
        </div>
    </div>
</div>
