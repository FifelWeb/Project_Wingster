
    <div class="container">
        <h2>Booking Meja</h2>

        {{-- Form untuk memilih waktu reservasi --}}
        <form method="GET" action="{{ route('booking.index') }}" class="mb-4">
            <label for="booking_time">Pilih Waktu Reservasi:</label>
            <input type="datetime-local" name="booking_time" id="booking_time"
                   value="{{ request('booking_time') }}" required>
            <button type="submit">Cek Ketersediaan</button>
        </form>

        {{-- Menampilkan hasil berdasarkan pilihan waktu --}}
        @if (request('booking_time'))
            @if ($availableTables->count())
                {{-- Form Booking --}}
                <form method="POST" action="{{ route('booking.store') }}">
                    @csrf
                    <div>
                        <label for="table_id">Pilih Meja:</label>
                        <select name="table_id" id="table_id" required>
                            <option value="" disabled selected>-- Pilih Meja --</option>
                            @foreach ($availableTables as $table)
                                <option value="{{ $table->id }}">Meja {{ $table->table_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kirim ulang waktu booking --}}
                    <input type="hidden" name="booking_time" value="{{ request('booking_time') }}">

                    <button type="submit">Booking</button>
                </form>
            @else
                <p><strong>Tidak ada meja tersedia</strong> pada waktu tersebut.</p>
            @endif
        @else
            <p>Silakan pilih waktu reservasi untuk melihat ketersediaan meja.</p>
        @endif
    </div>

