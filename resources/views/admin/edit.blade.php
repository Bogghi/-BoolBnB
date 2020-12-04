@extends('layouts.guests')

@section('content')
<div class="container">
  <section>
    <h1>Aggiungi un appartamento</h1>
    <form action="{{route("admin.apartment.update", $apartment->id)}}" method="POST" enctype="multipart/form-data">

      @csrf
      @method("PUT")

      <div class="form-group">
        <label for="title">Titolo</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Digita un titolo per questo annuncio" max="100" value="{{old("title") ? old("title") : $apartment->title}}">
      </div>
      @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="form-group">
        <label for="address">Indirizzo</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Digita l'indirizzo del tuo appartamento" value="{{old("address") ? old("address") : $apartment->address}}">
      </div>
      @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="form-inline mt-sm-5">
        <label for="rooms_number">Numero di stanze</label>
        <input type="number" class="form-control mb-2 m-sm-2" id="rooms_number" name="rooms_number" min="1" value="{{old("rooms_number") ? old("rooms_number") : $apartment->rooms_number}}" required>


        <label for="beds_number">Numeri di posti letto</label>
        <input type="number" class="form-control mb-2 m-sm-2" id="beds_number" name="beds_number" min="1" value="{{old("beds_number") ? old("beds_number") : $apartment->beds_number}}" required>


        <label for="bathrooms_number">Numero di bagni</label>
        <input type="number" class="form-control mb-2 m-sm-2" id="bathrooms_number" name="bathrooms_number" min="1" value="{{old("bathrooms_number") ? old("bathrooms_number") : $apartment->bathrooms_number}}" required>


        <label for="square_meters">Dimensione in metri quadrati</label>
        <input type="number" class="form-control mb-2 m-sm-2" id="square_meters" name="square_meters" value="{{old("square_meters") ? old("square_meters") : $apartment->square_meters}}" required>
      </div>
      @error('rooms_number')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      @error('beds_number')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      @error('square_meters')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="form-group mt-sm-4">
        <label for="description">Descrizione</label>
        <textarea class="form-control" id="description" name="description" rows="5" min="50" max="150" placeholder="Scrivi una descrizione del tuo appartamento..." style="resize: none;">
          {{old("description") ? old("description") : $apartment->description}}
        </textarea>
      </div>
      @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
        <div>
          <label>Servizi</label>
        </div>

      @php
      if (!old("services")) {
          $apartmentServices = [];
          foreach($apartment->services as $service) {
            $apartmentServices[] = $service->id;
          }
        }
      @endphp

      @if(!old("services"))
        @foreach ($services as $service)
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="{{$service->id}}" name="services[]" {{in_array($service->id, $apartmentServices) ? "checked" : ""}} value="{{$service->id}}">
          <label class="form-check-label" for="{{$service->id}}">{{$service->name}}</label>
        </div>
        @endforeach
      @else
        @foreach ($services as $service)
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="{{$service->id}}" name="services[]" {{in_array($service->id, old("services")) ? "checked" : ""}} value="{{$service->id}}">
          <label class="form-check-label" for="{{$service->id}}">{{$service->name}}</label>
        </div>
        @endforeach
      @endif
      @error('services')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="form-check mt-sm-4">
        <label for="visibility">Non visibile</label>
      <input type="checkbox" class="form-controll mb-2 m-sm-2" id="visibility" name="visibility" value="0" {{ $apartment->visibility == 0 ? "checked" : "" }}>
      </div>
      @error('visibility')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="form-group mt-sm-4">
        <label for="cover_image">Immagine di copertina</label>
        <input type="file" class="d-block" id="cover_image" name="cover_image" accept="image/*">
      </div>
      @error('cover_image')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="apartment-cover">
        <img src="{{asset("storage/" . $apartment->cover_image)}}" alt="" style="width:200px; height:200px">
      </div>

      <div class="form-group mt-sm-4">
        <label for="images">Immagini aggiuntive (fino a 5)</label>
        <input type="file" class="d-block" id="images" name="images[]" accept="image/*" multiple>
      </div>
      @error('images')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      @if ($apartment_images)
      <div class="apartment-images my-sm-4 d-flex">
        @foreach ($apartment_images as $apartment_image)
          <div class="apartment-image">
            <img src="{{asset("storage/" . $apartment_image->image_path)}}" alt="">
            <form action="{{route("admin.image.destroy", $apartment_image->id)}}" method="POST">
              @csrf
              @method("DELETE")
              <input type="submit" value="Elimina">
            </form>
          </div>
        @endforeach
      </div>
      @endif


      <button type="submit" class="btn btn-primary">Salva</button>
    </form>
  </section>
</div>

@endsection