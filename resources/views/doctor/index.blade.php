<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Barra de Navegación -->
    <nav class="bg-blue-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-lg font-semibold">Hospital Management</a>
            <div>
                <a href="#" class="text-white mr-4 hover:underline">Dashboard</a>
                <a href="{{ route('doctor.patients.index') }}" class="text-white mr-4 hover:underline">Pacientes</a>
                <a href="{{ route('doctor.medical_infos.create') }}" class="text-white mr-4 hover:underline">Añadir Información Médica</a>
                <a href="#" class="text-white hover:underline">Perfil</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container mx-auto mt-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Bienvenido, Doctor</h1>
            <p class="mb-4"></p>

            <!-- Calendario Interactivo -->
            <div x-data="calendarApp()" x-init="init()" class="bg-gray-100 p-4 rounded-lg shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <span x-text="monthNames[month]" class="text-xl font-bold"></span>
                        <span x-text="year" class="text-xl font-bold"></span>
                    </div>
                    <div>
                        <button @click="prevMonth()" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Prev</button>
                        <button @click="nextMonth()" class="bg-blue-500 text-white px-4 py-2 rounded">Next</button>
                    </div>
                </div>
                <div class="grid grid-cols-7 gap-2 text-center">
                    <template x-for="(day, index) in daysOfWeek" :key="index">
                        <div class="font-bold" x-text="day"></div>
                    </template>
                    <template x-for="blankday in blankdays">
                        <div class="text-center border p-2"></div>
                    </template>
                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                        <div @click="showAppointments(date)" class="cursor-pointer text-center border p-2 hover:bg-blue-200"
                            :class="{'bg-blue-500 text-white': isToday(date), 'bg-blue-300': selectedDate && selectedDate.getDate() === date && selectedDate.getMonth() === month && selectedDate.getFullYear() === year}">
                            <span x-text="date"></span>
                        </div>
                    </template>
                </div>

                <!-- Panel de Citas Diarias -->
                <div x-show="selectedDate !== null" class="mt-6 bg-white p-4 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-4">Citas para <span x-text="selectedDateText"></span></h2>
                    <div class="grid grid-cols-1 gap-4">
                        <template x-for="hour in dailyHours" :key="hour">
                            <div class="flex justify-between items-center p-2 border-b">
                                <div x-text="hour" class="font-medium"></div>
                                <div class="text-sm text-gray-500">No appointments</div> <!-- Aquí puedes agregar lógica para mostrar las citas -->
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calendarApp() {
            return {
                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                selectedDate: null,
                selectedDateText: '',
                daysOfWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                dailyHours: [
                    '12:00 AM', '1:00 AM', '2:00 AM', '3:00 AM', '4:00 AM', '5:00 AM', '6:00 AM', '7:00 AM', '8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM',
                    '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM', '6:00 PM', '7:00 PM', '8:00 PM', '9:00 PM', '10:00 PM', '11:00 PM'
                ],

                init() {
                    let today = new Date();
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    this.getNoOfDays();
                },

                isToday(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);
                    return today.toDateString() === d.toDateString();
                },

                showAppointments(date) {
                    this.selectedDate = new Date(this.year, this.month, date);
                    this.selectedDateText = `${this.monthNames[this.month]} ${date}, ${this.year}`;
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                    let dayOfWeek = new Date(this.year, this.month).getDay();

                    let blankdaysArray = [];
                    for ( var i=1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for ( var i=1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }

                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                },

                prevMonth() {
                    if (this.month == 0) {
                        this.month = 11;
                        this.year--;
                    } else {
                        this.month--;
                    }
                    this.getNoOfDays();
                    this.selectedDate = null;
                },

                nextMonth() {
                    if (this.month == 11) {
                        this.month = 0;
                        this.year++;
                    } else {
                        this.month++;
                    }
                    this.getNoOfDays();
                    this.selectedDate = null;
                }
            }
        }
    </script>
</body>
</html>
