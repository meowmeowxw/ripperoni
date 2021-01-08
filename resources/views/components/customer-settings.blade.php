<div class="card m-1">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
        <div class="card card-body justify-content-center m-1">
            <form method="POST" action="{{route('customer.settings')}}">
                @csrf

                <x-FormInput name="name" idAndFor="name{{$id}}" :lblName="__('Name')" :inputValue="$name" type="text" />
                <x-FormInput name="email" idAndFor="email{{$id}}" :lblName="__('Email')" :inputValue="$email" type="email" />

                <button type="submit" class="btn btn-lg btn-primary btn-block">
                    {{ __('Save') }}
                </button>

            </form>
        </div>
    </div>
</div>
