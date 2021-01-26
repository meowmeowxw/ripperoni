<div class="col-8 m-1">
    <x-card>
        <x-slot name="title">
            {{__('Add Beer')}}
        </x-slot>
        <x-form.form action="{{route('seller.product.add')}}" enctype="multipart/form-data"
                     btntext="{{ __('Save') }}" btnaddclass="btn-block">

            <x-FormInput name="name" idAndFor="nameNew" :lblName="__('Name')" type="text" inputValue="{{old('name')}}"/>
            <div class="form-row">
                <div id="div-description" class="col">
                    <label for="description">{{__('Description')}}</label>
                    <textarea id="description" placeholder="{{__('Description')}}" type="text"
                              class="form-control @error('description') is-invalid @enderror"
                              required="" name="description" rows="5"></textarea>

                    @error('description')
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <x-FormInput name="price" idAndFor="priceNew" :lblName="__('Price')" type="number" step="0.01" inputValue="{{old('price')}}"/>
            <x-FormInput name="quantity" idAndFor="quantityNew" :lblName="__('Quantity')" type="number" inputValue="{{old('quantity')}}" />
            <x-FormInput name="alcohol" idAndFor="alcoholNew" :lblName="__('Alcohol level')" type="number"
                         step="0.01" inputValue="{{old('alcohol')}}"/>
            <x-FormInput name="cl" idAndFor="cl" :lblName="__('Cl')" type="number" inputValue="{{old('cl')}}"/>

            <x-form.form-category name="category" idAndFor="category" lblValue="Category"/>

            <x-form.form-img name="logo" idAndFor="logoNew" lblValue="{{ __('Select Image') }}"/>
        </x-form.form>
    </x-card>
</div>
