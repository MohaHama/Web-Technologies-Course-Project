<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking System</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>

</head>

<body>
    <header>
        <div id="frontpageAdminPage">
            <nav id="desktop-nav">
                <div class="logo">Event Website WebTech</div>
                <div>
                    <ul class="nav-links">
                        <li><a href="{{route('event.index')}}#frontpageContext">HOME</a></li>
                        <li><a dusk="to-create" href="{{route('event.create')}}">CREATE</a></li> <!-- Later I can change this to admin page before creating, so user needs to log in before creating event -->
                    </ul>
                </div>
            </nav>
        </div>
    </header>


    <main>
        <section id="admin">
            <div class="container">
                <h1>UPDATE AN EVENT HERE!</h1>
                <h2><strong>UPDATE</strong></h2>
                <div>
                    @if(session()->has('succes'))
                    <div class="success-message">
                        {{session('succes')}}
                    </div>
                    @endif
                </div>
                <form id="eventForm" class="form" method="post" action="{{route('event.update', ['id' => $event->id])}}">
                    <!-- @csrf adds a hidden security token to the form that protects it from malicious requests 
         by ensuring the form was submitted from your own website, not another site. -->
                    @csrf
                    @method('put')
                    <input
                        id="fHost"
                        name="host"
                        class="input"
                        type="text"
                        placeholder="Host"
                        required
                        value="{{$event->host}}" />
                    <input
                        value="{{$event->event}}"
                        name="event"
                        id="fEvent"
                        class="input"
                        type="text"
                        placeholder="Event"
                        required />
                    <input
                        value="{{$event->description}}"
                        name="description"
                        id="fDesc"
                        class="input"
                        type="text"
                        placeholder="Description"
                        required />
                    <input
                        value="{{$event->location}}"
                        name="location"
                        id="fLoc"
                        class="input"
                        type="text"
                        placeholder="Location"
                        required />
                    <input value="{{$event->date}}" name="date" id="fDate" class="input" type="datetime-local" required />
                    <input
                        value="{{$event->price}}"
                        name="price"
                        id="fPrice"
                        class="input"
                        type="number"
                        placeholder="Price"
                        min="0"
                        step="0.01"
                        required />
                    <input
                        value="{{$event->available_seats}}"
                        name="available_seats"
                        id="fSeats"
                        class="input"
                        type="number"
                        placeholder="Seats"
                        min="0"
                        required />
                    <button id="addBtn" type="submit" class="btn">Update</button>
                </form>
            </div>
            <!-- Form validating: if there is any errors then the errors will be dislplayed in the view for the user! -->
            <div>
                @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </section>
    </main>

    <footer id="footer">
        <div id="footerContainer">
            <p>MADE BY: Mohammed Hamarash</p>
            <p>This website is for Web Technology course</p>
        </div>
    </footer>
</body>

</html>