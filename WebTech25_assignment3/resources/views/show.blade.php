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

        <!-- service section for atendees -->
        <section id=" eventSection">
            <div id="eventsHeader">
                <h1>MORE INFO ABOUT "{{$event->event}}" EVENT</h1>
                <div id="eventsContainer">
                    <table id="eventsTable">
                        <!-- Table Row -->
                        <tr class="eventsTableRow" id="tableRowName">
                            <th class="eventsTableHeader">Host</th>
                            <th class="eventsTableHeader">Host</th>
                            <th class="eventsTableHeader">Event</th>
                            <th class="eventsTableHeader">Description</th>
                            <th class="eventsTableHeader">Location</th>
                            <th class="eventsTableHeader">Date</th>
                            <th class="eventsTableHeader">Price</th>
                            <th class="eventsTableHeader">Available Seats</th>
                            <th class="eventsTableHeader">Created At</th>
                            <th class="eventsTableHeader">Updated At</th>
                        </tr>
                        <tr id="TableDataRow">
                            <td class="eventsTableData" id="tableHost">{{$event->host->name}}</td>
                            <td class="eventsTableData" id="tableEventName">{{$event->event}}</td>
                            <td class="eventsTableData" id="tableDescription">{{$event->description}}</td>
                            <td class="eventsTableData" id="tableLocation">{{$event->location}}</td>
                            <td class="eventsTableData" id="tableDate">{{$event->date}}</td>
                            <td class="eventsTableData" id="tablePrice">{{$event->price}}</td>
                            <td class="eventsTableData" id="tableSeats">{{$event->available_seats}}</td>
                            <td class="eventsTableData" id="tablePrice">{{$event->created_at}}</td>
                            <td class="eventsTableData" id="tableSeats">{{$event->updated_at}}</td>
                        </tr>
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