@extends('frontend.layouts.main')
@include('frontend.sections.mettatags')
@section('content')
@php
    use App\Helpers\Cmf;
@endphp
<!--===== HERO AREA STARTS =======-->
    <div class="hero1-section-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero1-header heading1">
                        <h5 >
                            <img src="{{ url('newfront/assets/img/icons/sub-logo1.svg') }}" alt="Logo" />
                            Join Dubai's Thriving Art Community
                        </h5>
                        <div class="space16"></div>
                        <h1 class="text-anime-style-3">
                            Register as an Artist <br class="d-lg-block d-none" />
                            and Showcase Your Talent
                        </h1>
                        <div class="space16"></div>
                        <p >
                            Be part of Dubai’s vibrant creative industry. <br class="d-lg-block d-none" />
                            Register today and get access to exclusive exhibitions, art festivals, and networking events.
                        </p>
                        <div class="space32"></div>
                        <div class="btn-area1" >
                            <a href="{{ url('register') }}" class="vl-btn1">Artist Registration</a>
                            <a href="{{ url('investment-request') }}" class="vl-btn1">Investment Request</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="header-images">
                        <!-- <div class="img1" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="{{ url('newfront/assets/img/all-images/hero/artist-showcase.png') }}" alt="Artists Performing" />
                        </div> -->
                        <div class="images-content-area">
                            <h3>DUBAI ARTIST EXPO 2025</h3>
                            <div class="space12"></div>
                            <a href="#">March 10-12, 2025</a>
                            <div class="space12"></div>
                            <a href="#">Dubai International Art Center</a>
                            <div class="space16"></div>
                            <p>Showcase your talent at the biggest art and music festival in Dubai. Connect with art collectors, agencies, and fellow artists.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--===== HERO AREA ENDS =======-->

<!--===== EVENT AREA STARTS =======-->
    <div class="blog1-section-area all-event-section sp2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="event-header heading2 space-margin60 text-center">
                        <h5 >All Upcoming Event</h5>
                        <div class="space16"></div>
                        <h2 class="text-anime-style-3">Upcoming Events</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="blog1-auhtor-boxarea">
                            <div class="content-area all-events p-0">
                                <div class="img1 image-anime">
                                    <img src="{{ url('images/' . $event->image) }}" alt="" />
                                </div>
                                <div class="p-3">
                                    <ul>
                                        <li>
                                            <a href="#"><img src="{{ url('newfront/assets/img/icons/calender1.svg') }}" alt="" />{{ Cmf::date_format($event->created_at) }}</a>
                                        </li>
                                    </ul>
                                    <div class="space20"></div>
                                    <a href="{{ url('events/' . $event->id )}}">{{ $event->name }}</a>
                                    <div class="space16"></div>
                                    <p>{!! $event->description !!}</p>
                                    <div class="space24"></div>
                                    <div class="btn-area1">
                                        <a href="{{ url('events/' . $event->id )}}" class="vl-btn1 event-btn" data-id="{{ $event->id }}">Become Attendee</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12 text-center">
                    <div class="btn-area1">
                        <a href="{{ url('all-upcomingevents') }}" class="vl-btn1 event-btn">all UpComing Events</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== EVENT AREA ENDS =======-->

    <div class="memory1-section-area sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="memory-header text-center heading2 space-margin60">
                        <h5 data-aos="fade-left" data-aos-duration="800" class="aos-init aos-animate">Event Photos</h5>
                        <div class="space16"></div>
                        <h2 class="text-anime-style-3" style="perspective: 400px;"><div class="split-line" style="display: block; text-align: center; position: relative;"><div style="position:relative;display:inline-block;"><div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">Recent Photos 2024</div></div></div></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                   <div class="memory-slider-area owl-carousel owl-loaded owl-drag">
                      <div class="owl-stage-outer">
                         <div class="owl-stage" style="transition: 2s; width: 4421px; transform: translate3d(-2210px, 0px, 0px);">
                            @foreach(DB::table('photos')->where('status' , 1)->get() as $p)
                            <div class="owl-item cloned" style="width: 412.003px; margin-right: 30px;">
                               <div class="memory-boxarea">
                                  <div class="img1 image-anime">
                                     <img src="{{ url('images/' . $p->photo) }}" alt="">
                                  </div>
                                  <div class="content-area">
                                     <div class="arrow">
                                        <a href="javascript:void(0)"><i class="fa-solid fa-arrow-right"></i></a>
                                     </div>
                                     <div class="space18"></div>
                                     <p>{{ DB::table('photocategories')->where('id' , $p->category_id)->first()->name }}</p>
                                     <div class="space12"></div>
                                     <a href="javascript:void(0)">{{ $p->name }}</a>
                                  </div>
                               </div>
                            </div>
                            @endforeach
                         </div>
                      </div>
                      <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="fa-solid fa-angle-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="fa-solid fa-angle-right"></i></button></div>
                      <div class="owl-dots disabled"></div>
                   </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pricing-lan-section-area sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="heading2 text-center space-margin60">
                        <h5>plan pricing</h5>
                        <div class="space18"></div>
                        <h2>Event Pass &amp; Tickets</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($plan as $r)
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-boxarea">
                        <h5>{{ $r['local']->name ?? 'N/A' }}</h5>
                        <div class="space20"></div>
                        <h2> 
                            @if(strtoupper($r['stripe']->currency ?? '') == 'USD')$@endif{{ number_format(($r['stripe']->amount ?? 0) / 100) }}
                        <span>/One Person</span></h2>
                        <div class="space8"></div>
                        <div class="plan_description">
                            {!! $r['local']->description !!}
                        </div>
                        <div class="space28"></div>
                        <div class="btn-area1">
                            @if(Auth::guard('artist')->check())
                            <a href="{{ url('user/buy-plan') }}/{{ $r['local']->slug }}" class="vl-btn1">buy a plan</a>
                            @else
                            <a href="{{ url('register') }}" class="vl-btn1">Register Now</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--===== EVENT AREA STARTS =======-->
    <div class="event1-section-area sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="event-header heading2 space-margin60 text-center">
                        <h5 >Calender</h5>
                        <div class="space16"></div>
                        <h2 class="text-anime-style-3">Calender OF Event</h2>
                    </div>
                </div>
            </div>
            <div class="calendar-container">
                <div class="calendar-header">
                    <button id="prevMonth"><i class="fas fa-arrow-left"></i> </button>
                    <h4 id="currentMonth"></h4>
                    <button id="nextMonth"><i class="fas fa-arrow-right"></i></button>
                </div>
                <table class="calendar-table">
                    <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>
                    <tbody id="calendarBody"></tbody>
                </table>
                <div class="event-form row">
                    <div class="col-lg-4">
                        <input type="hidden" id="eventDate" class="form-control"> 
                    </div>
                    <div class="col-lg-4">
                        <input type="hidden" id="eventText" placeholder="Event Details" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        <button id="addEvent" style="display: none;" class="vl-btn1">Add Event</button>
                    </div>
                </div>
                <div id="eventList"></div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== EVENT AREA ENDS =======-->

 
<!--===== BLOG AREA STARTS =======-->
    <div class="blog1-section-area sp2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="blog-header text-center heading2 space-margin60">
                        <h5 >Latest Insights</h5>
                        <div class="space16"></div>
                        <h2 class="text-anime-style-3">Stay Updated with Industry Trends</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(DB::table('blogs')->where('status' , 1)->get() as $b)
                    <div class="col-lg-4 col-md-6" >
                        <div class="blog1-auhtor-boxarea">
                            <div class="img1 image-anime">
                                <img src="{{ url('images') }}/{{ $b->image }}" alt="" />
                            </div>

                            <div class="content-area">
                                <ul>
                                    <li>
                                        <a href="#"><img src="{{ url('newfront/assets/img/icons/calender1.svg') }}" alt="" />{{ Cmf::date_format($b->created_at) }}</a>
                                    </li>
                                </ul>
                                <div class="space20"></div>
                                <a href="{{ url('blog') }}/{{ $b->id }}">{{ $b->title }}</a>
                                <div class="space24"></div>
                                <div class="btn-area1">
                                    <a href="{{ url('blog') }}/{{ $b->id }}" class="vl-btn2">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

<!--===== BLOG AREA ENDS =======-->

<style type="text/css">
.calendar-container {
    font-family: Arial, sans-serif;
    width: 100%;
    text-align: center;
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.calendar-header button {
    background: #5cc99f;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 4px;
    transition: 0.3s;
}

.calendar-header button:hover {
    background: #5cc99f;
}

.calendar-table {
    width: 100%;
    border-collapse: collapse;
}

.calendar-table th {
    background: #5cc99f;
    color: white;
    padding: 10px;
    font-size: 14px;
}

.calendar-table td {
/*    border: 1px solid #ddd;*/
    padding: 12px;
    text-align: center;
    font-size: 16px;
    transition: 0.3s;
    cursor: pointer;
    position: relative;
}

.calendar-table td:hover {
    background: #f1f1f1;
}

/* 🔵 Selected Date (Circular Box) */
.selected {
    background: #5cc99f !important;
    color: white !important;
    border-radius: 50%;
    font-weight: bold;
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* 🔴 Today's Date Highlight */
.today {
    background: #5cc99f !important;
    color: white !important;
    border-radius: 50%;
    font-weight: bold;
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* 🟢 Event Days */
.event {
    background: #5cc99f !important;
    color: white !important;
    border-radius: 50%;
    font-weight: bold;
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* 📆 Event Form */
.event-form {
    align-items: baseline;
    margin-top: 15px;
    display: flex;
    justify-content: space-between;
}

.event input {
    padding: 5px;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 4px;
}

#eventList {
    margin-top: 15px;
    text-align: left;
    font-size: 14px;
}

</style>
@endsection
@section('script')
<script>
function toggleColors(id) {
    var extraColors = document.getElementById("extraColors-" + id);
    var toggleLink = document.getElementById("toggleLink-" + id);

    if (extraColors.style.display === "none") {
        extraColors.style.display = "inline";
        toggleLink.textContent = "Read less";
    } else {
        extraColors.style.display = "none";
        toggleLink.textContent = "Read more";
    }
}
</script>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function () {
    const calendarBody = document.getElementById("calendarBody");
    const currentMonth = document.getElementById("currentMonth");
    const prevMonthBtn = document.getElementById("prevMonth");
    const nextMonthBtn = document.getElementById("nextMonth");
    const eventDate = document.getElementById("eventDate");
    const eventText = document.getElementById("eventText");
    const addEventBtn = document.getElementById("addEvent");
    const eventList = document.getElementById("eventList");

    let date = new Date();
    let events = {};
    let selectedCell = null; // Track selected date cell

    function renderCalendar() {
        const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        const today = new Date();
        calendarBody.innerHTML = "";
        currentMonth.textContent = firstDay.toLocaleString("default", { month: "long", year: "numeric" });

        let row = document.createElement("tr");

        // Fill empty cells for days before the 1st of the month
        for (let i = 0; i < firstDay.getDay(); i++) {
            const emptyDate = new Date(date.getFullYear(), date.getMonth(), 1 - (firstDay.getDay() - i));
            const cell = document.createElement("td");
            cell.classList.add("calendar-day");
            cell.setAttribute("data-date", emptyDate.toISOString().split("T")[0]);
            row.appendChild(cell);
        }

        for (let day = 1; day <= lastDay.getDate(); day++) {
            const cell = document.createElement("td");
            cell.classList.add("calendar-day");
            const cellDate = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
            cell.setAttribute("data-date", cellDate);
            cell.textContent = day;

            if (cellDate === today.toISOString().split("T")[0]) {
                cell.classList.add("today");
            }

            if (events[cellDate]) {
                cell.classList.add("event");
                cell.title = events[cellDate];
            }

            cell.addEventListener("click", function () {
                if (selectedCell) {
                    selectedCell.classList.remove("selected");
                }
                selectedCell = cell;
                selectedCell.classList.add("selected");
                eventDate.value = cellDate;
            });

            row.appendChild(cell);

            if ((firstDay.getDay() + day) % 7 === 0) {
                calendarBody.appendChild(row);
                row = document.createElement("tr");
            }
        }

        if (row.children.length) {
            calendarBody.appendChild(row);
        }

        updateEventList();
    }


    function updateEventList() {
        eventList.innerHTML = "<h4></h4>";
        for (let key in events) {
            eventList.innerHTML += `<p><strong>${key}:</strong> ${events[key]}</p>`;
        }
    }

    prevMonthBtn.addEventListener("click", function () {
        date.setMonth(date.getMonth() - 1);
        renderCalendar();
    });

    nextMonthBtn.addEventListener("click", function () {
        date.setMonth(date.getMonth() + 1);
        renderCalendar();
    });

    addEventBtn.addEventListener("click", function () {
        if (eventDate.value && eventText.value) {
            events[eventDate.value] = eventText.value;
            renderCalendar();
            eventDate.value = "";
            eventText.value = "";
        } else {
            alert("Please enter a valid date and event description.");
        }
    });

    renderCalendar();
});

</script>
<script type="text/javascript">
    $(document).on("click", ".calendar-day", function () {
        let selectedDate = $(this).data("date");
        $("#eventDate").val(selectedDate); // if needed

        $.ajax({
            url: "{{ url('getevents') }}", // your backend route
            method: "GET",
            data: { date: selectedDate },
            success: function (response) {
                $("#pills-home").html(response); // replace the content inside the event section
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });

</script>
@endsection