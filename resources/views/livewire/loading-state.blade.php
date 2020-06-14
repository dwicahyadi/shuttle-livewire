<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div wire:loading class="text-center position-absolute position-fixed w-100" style="z-index: 9999">
        <div class="card bg-secondary w-50 mx-auto">
            <div class="card-body">
                <h2 class="text-white">loading...</h2>
            </div>
        </div>
    </div>

    <div wire:offline class="text-center position-absolute position-fixed w-100" style="z-index: 9999">
        <div class="card bg-secondary w-50 mx-auto">
            <div class="card-body">
                <h2 class="text-white">Not Connected</h2>
            </div>
        </div>
    </div>
</div>
