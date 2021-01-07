<div class="card m-1">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
        <div class="card card-body justify-content-center m-1">
            <form method="POST" action="{{route('seller.settings')}}">
                @csrf

                <x-FormInput name="name" idAndFor="name{{$id}}" :lblName="__('Name')" :inputValue="$name" type="text" />
                <x-FormInput name="email" idAndFor="email{{$id}}" :lblName="__('Email')" :inputValue="$email" type="email" />
                <x-FormInput name="company" idAndFor="company{{$id}}" :lblName="__('Company')" :inputValue="$company" type="text" />
                <x-FormInput name="credit_card" idAndFor="credit_card{{$id}}" :lblName="__('Credit Card')" :inputValue="$credit_card" type="text" />

                <button type="submit" class="btn btn-lg btn-primary btn-block">
                    {{ __('Save') }}
                </button>

            </form>
        </div>
    </div>
</div>
