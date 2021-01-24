<div class="col-8 m-1">
    <x-card>
        <x-slot name="title">
            {{__('Add Beer')}}
        </x-slot>
        <x-form.form action="{{route('seller.product.add')}}" enctype="multipart/form-data"
                     btntext="{{ __('Save') }}" btnaddclass="btn-lg btn-block">

            <x-FormInput name="name" idAndFor="nameNew" :lblName="__('Name')" type="text"/>
            <x-FormInput name="description" idAndFor="descriptionNew" :lblName="__('Description')" type="text"/>
            <x-FormInput name="price" idAndFor="priceNew" :lblName="__('Price')" type="number" step="0.01"/>
            <x-FormInput name="quantity" idAndFor="quantityNew" :lblName="__('Quantity')" type="number"/>
            <x-FormInput name="alcohol" idAndFor="alcoholNew" :lblName="__('Alcohol level')" type="number"
                         step="0.01"/>
            <x-FormInput name="cl" idAndFor="cl" :lblName="__('Cl')" type="number"/>

            <x-form.form-category name="category" idAndFor="category" lblValue="Category"/>

            <x-form.form-img name="logo" idAndFor="logoNew" lblValue="{{ __('Select Image') }}"/>
        </x-form.form>
    </x-card>
</div>
