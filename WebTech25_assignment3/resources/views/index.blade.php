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
    <nav id="desktop-nav">
      <div class="logo">Event Website WebTech</div>
      <div>
        <ul class="nav-links">
          <li><a href="{{route('event.index')}}#frontpageContext">HOME</a></li>

          <!-- Guest can only see this -->
          @guest
          <li><a class="borderLink" href="{{route('signUp.form')}}">Sign Up</a></li>
          <li><a class="borderLink" href="{{route('login.form')}}">Log In</a></li>
          @endguest

          <!-- Only authenticated user can see this / after loggin in -->
          @auth
          <li><a id="create" dusk="to-create" href="{{route('event.create')}}">CREATE</a></li>
          <li><span id="username">Hello, {{ auth()->user()->name }}</span></li>
          <li>
            <form method="POST" action="{{ route('logOut') }}">
              @csrf
              <button id="logOut-Btn" type="submit">Log Out</button>
            </form>
          </li>

          @endauth
        </ul>
      </div>
    </nav>
  </header>

  <main>
    <!-- Frontpage content -->
    <section id="frontpageContext">
      <div id="frontpage-text">
        <h1 id="WelcomeTitle">ONLINE BOOKING <br />FOR EVENT</h1>
        <p class="welInfoP">
          Stay updated with the latest events <br />
          See schedules, details, and any changes in one place <br />
          <br />
          On this site you can:
        </p>
        <ul>
          <li>
            <p>
              <img class="listIcon" src="{{ asset('assets/img/schedule.png') }}" />
              <strong>UPCOMING EVENTS:</strong> Browse the latest events
              happening at our venue.
            </p>
          </li>
          <li>
            <p>
              <img class="listIcon" src="{{ asset('assets/img/coupon.png')}}" />
              <strong>EVENTS LIST:</strong> Here you can see all scheduled
              events.
            </p>
          </li>
        </ul>
        <p class=" welInfoP">
          Check out upcoming events and track updates as they happen
        </p>
      </div>
      <img id="frontpagePIC" src="{{ asset('assets/img/frontpagePIC.jpg') }}" />
    </section>

    <!-- service section for atendees -->
    <section id=" eventSection">
      <div id="eventsHeader">
        <h1>UPCOMING EVENTS</h1>
        <div>
          @if(session()->has('succes'))
          <div dusk="success-msg" class="success-message">
            {{session('succes')}}
          </div>
          @endif
        </div>
        <div id="eventsContainer">
          <table id="eventsTable">
            <!-- Table Row -->
            <tr class="eventsTableRow" id="tableRowName">
              <th class="eventsTableHeader">Host</th>
              <th class="eventsTableHeader">Event</th>
              <th class="eventsTableHeader">Description</th>
              <th class="eventsTableHeader">Location</th>
              <th class="eventsTableHeader">Date</th>
              <th class="eventsTableHeader">Price</th>
              <th class="eventsTableHeader">Available Seats</th>
              <th class="eventsTableHeader">Show</th>
              <!-- Only logged in users can see this -->
              @auth
              <th>Update</th>
              <th>Delete</th>
              @endauth
            </tr>


            <!-- we loop through the array and print every attribute from each row -->
            @foreach($events as $event)
            <tr dusk="element" id="TableDataRow">
              <td class="eventsTableData" id="tableHost">{{$event->host->name}}</td>
              <td class="eventsTableData" id="tableEventName">{{$event->event}}</td>
              <td class="eventsTableData" id="tableDescription">{{$event->description}}</td>
              <td class="eventsTableData" id="tableLocation">{{$event->location}}</td>
              <td class="eventsTableData" id="tableDate">{{$event->date}}</td>
              <td class="eventsTableData" id="tablePrice">{{$event->price}}</td>
              <td class="eventsTableData" id="tableSeats">{{$event->available_seats}}</td>
              <th class="eventsTableHeader"><a dusk="to-show" href="{{ route('event.show', ['id' => $event->id]) }}"><button class="btn" id="showBtn">Show More</button></a></th>

              @auth
              <th class="eventsTableHeader"><!-- automatically send the id of the event user presses "edit" on to the route  -->
                <a dusk="to-edit" href="{{ route('event.edit', ['id' => $event->id]) }}"><button class="btn" id="updateBtn">Edit</button></a>
              </th>
              <th class="eventsTableHeader">
                <!-- Form that sends a DELETE request to the event.delete 
                 route with this events ID when the user clicks the delete button -->
                <form dusk="to-delete" class="formBtn" method="post" action="{{route('event.delete', ['id' => $event->id])}}">
                  <!-- @csrf adds a hidden security token to the form that protects it from malicious requests 
                        by ensuring the form was submitted from your own website not another site -->
                  @csrf
                  @method('delete')
                  <button class="btn" id="deleteBtn" type="submit" class="blue-button">Delete</button>
                </form>
              </th>
              @endauth
            </tr>
            @endforeach
          </table>
        </div>
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