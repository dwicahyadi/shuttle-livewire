<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <form wire:submit.prevent="save">
        <div class="row mt-4 animate__animated animate__bounceInUp animate__fast">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="company-tab" data-toggle="pill" href="#company" role="tab" aria-controls="company" aria-selected="true"><i class="far fa-building"></i> Profil Perusahaan</a>
                    <a class="nav-link" id="seat-tab" data-toggle="pill" href="#seat" role="tab" aria-controls="seat" aria-selected="false"><i class="fas fa-th-large"></i> Seat</a>
                    <a class="nav-link" id="booking-tab" data-toggle="pill" href="#booking" role="tab" aria-controls="booking" aria-selected="false"><i class="fas fa-ticket-alt"></i> Booking</a>
                    <a class="nav-link" id="sms-tab" data-toggle="pill" href="#sms" role="tab" aria-controls="sms" aria-selected="false"><i class="fas fa-comment-dots"></i> Layanan SMS</a>
                </div>
                <hr>
                <button class="btn btn-success btn-block"><i class="far fa-save"></i> Simpan</button>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="company" role="tabpanel" aria-labelledby="company-tab">
                        <h4>Profil Perusahaan</h4>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Perusahaan</label>
                                <input type="text" wire:model.lazy="company_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" wire:model.lazy="company_address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text" wire:model.lazy="company_phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" wire:model.lazy="company_phone" class="form-control">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Logo Url</label>
                                <input type="text" wire:model.lazy="company_logo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tagline</label>
                                <input type="text" wire:model.lazy="company_tagline" class="form-control">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Bank</label>
                                <input type="text" wire:model.lazy="company_bank_account" class="form-control" wire:model.lazy="">
                            </div>
                            <div class="form-group">
                                <label>Nomor Rekening</label>
                                <input type="text" wire:model.lazy="company_bank_account_number" class="form-control" wire:model.lazy="">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seat" role="tabpanel" aria-labelledby="seat-tab">
                        <h4>Seat</h4>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Default Total Seat</label>
                                <input type="number" class="form-control" wire:model.lazy="seat_total">
                            </div>
                            <div class="form-group">
                                <label>Seat per baris</label>
                                <input type="number" class="form-control" wire:model.lazy="seat_per_row">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                        <div class="col-6">
                            <h4>Booking</h4>
                            <div class="form-group">
                                <label>Maksimal Reschedule</label>
                                <input type="number" class="form-control" wire:model.lazy="max_reschedule">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Maksimal waktu tunggu transfer (menit)</label>
                                <input type="number" class="form-control" wire:model.lazy="max_minutes_for_transfer_bank">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Bebas cetak ulang tiket</label>
                                <select class="form-control" wire:model.lazy="ticket_free_to_reprint">
                                    <option value="yes">Ya</option>
                                    <option value="no">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tampilkan logo di tiket</label>
                                <select class="form-control" wire:model.lazy="ticket_use_logo">
                                    <option value="yes">Ya</option>
                                    <option value="no">Tidak</option>
                                </select>
                            </div>
                            {{--<div class="form-group">
                                <label>Gunakan Qrcode</label>
                                <select class="form-control" wire:model.lazy="">
                                    <option value="yes">Ya</option>
                                    <option value="no">Tidak</option>
                                </select>
                            </div>--}}
                            <div class="form-group">
                                <label>Informasi tambahan di tiket</label>
                                <textarea class="form-control" wire:model.lazy="ticket_addtional_note"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sms" role="tabpanel" aria-labelledby="sms-tab">
                        <div class="col-6">
                            <h4>Layanan SMS</h4>
                            <div class="form-group">
                                <label>SMS servis Url</label>
                                <input type="text" class="form-control" wire:model.lazy="sms_services_url">
                            </div>
                            <div class="form-group">
                                <label>SMS API User</label>
                                <input type="text" class="form-control" wire:model.lazy="sms_services_user">
                            </div>
                            <div class="form-group">
                                <label>SMS API key</label>
                                <input type="text" class="form-control" wire:model.lazy="sms_services_key">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Gunakan layanan SMS</label>
                                <select class="form-control" wire:model.lazy="sms_services">
                                    <option value="yes">Ya</option>
                                    <option value="no">Tidak</option>
                                </select>
                            </div>
                            <hr>
                            <small>Opsi-opsi berikut membutuhkan Layanan SMS aktif</small>
                            <hr>
                            <div class="form-group">
                                <label>Gunakan OTP</label>
                                <select class="form-control" wire:model.lazy="otp_services">
                                    <option value="yes">Ya</option>
                                    <option value="no">Tidak</option>
                                </select>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Gunakan Greeting SMS</label>
                                <select class="form-control" wire:model.lazy="greeting_sms">
                                    <option value="yes">Ya</option>
                                    <option value="no">Tidak</option>
                                </select>
                                <small class="text-muted">SMS akan dikirim ketika keberangkatan</small>
                            </div>
                            <div class="form-group">
                                <label>Teks</label>
                                <textarea class="form-control" wire:model.lazy="greeting_sms_text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
