<div class="col">
    <div class="card text-center m-1">
        <div class="card-body">
            <h4 class="card-title m-1">{{ $title }}</h4>
            <div class="row justify-content-center align-items-center">
                <img src="{{$path}}" class="card-img-top m-1" alt=""/>

                <button class="btn btn-primary m-1" type="button" data-toggle="collapse"
                        data-target="#collapse{{$id ?? ''}}"
                        aria-expanded="false" aria-controls="collapseButton">
                    {{__('Edit')}}
                </button>
                <x-form.form id="delete" action="{{route('seller.product.delete')}}" btntext="{{ __('Delete') }}"
                             inputid="product_id_delete" inputvalue="{{$id}}" btnaddclass="m-1"/>
            </div>
            <div class="collapse" id="collapse{{$id ?? ''}}">
                <div class="card card-body justify-content-center m-1">
                    <x-form.form action="{{route('seller.product.edit')}}" btntext="{{ __('Save') }}"
                                 inputid="product_id" inputvalue="{{$id}}">

                        <x-FormInput name="name" idAndFor="name{{$id}}" :lblName="__('Name')" :inputValue="$name"
                                     type="text" errormessage="try" errorname="tt"/>
                        <x-FormInput name="description" idAndFor="description{{$id}}" :lblName="__('Description')"
                                     :inputValue="$description" type="text"/>
                        <x-FormInput name="price" idAndFor="price{{$id}}" :lblName="__('Price')" :inputValue="$price"
                                     type="number" step="0.01"/>
                        <x-FormInput name="quantity" idAndFor="quantity{{$id}}" :lblName="__('Quantity')"
                                     :inputValue="$quantity" type="number"/>
                    </x-form.form>
                </div>
            </div>
        </div>
    </div>
</div>
