@props([
    "classname"=>"",
    "buttontype"=>"",
    "buttontext"=>""
])

@push('styles')
<style>
    .buttoncolor{
        background-color: #0E3A52!important;
        color:white!important;
        font-weight: bold!important;
        border-radius:76px!important;
    
    }

    @media(max-width:350px){
      .buttoncolor {
        font-size: 0.7rem !important;
        padding: 19% 8% !important;
    }

        
    }

</style>
@endpush


<div>
    <button class ="buttoncolor {{ $classname }}" type="{{ $buttontype }}">{{ $buttontext }}</button>

</div>

