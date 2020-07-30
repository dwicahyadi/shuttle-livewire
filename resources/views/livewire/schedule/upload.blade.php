<div>
    <div class="container bg-white">
        <div class="row mt-4">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Jadwal.</strong> Upload Jadwal</h1>
                <p>Pembuatan jadwal menggunkan upload file</p>
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible animate__animated animate__bounceIn fade" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ session('message') }}

                    </div>
                @endif
            </div>

            <div class="col-md-12">
                <form wire:submit.prevent="save">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="date" class="form-control" wire:model="fromDate">
                    </div>
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" class="form-control" wire:model="toDate">
                    </div>

                    <div class="form-group">
                        <label>Upload file</label>
                        <input type="file" wire:model="file" required>

                        @error('file') <span class="error">{{ $message }}</span> @enderror
                    </div>



                    <button type="submit" class="btn btn-primary">Upload Jadwal</button>
                </form>
            </div>
        </div>
    </div>


</div>
