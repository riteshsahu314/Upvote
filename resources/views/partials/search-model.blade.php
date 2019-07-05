<div class="modal fade" id="searchBox" tabindex="-1" role="dialog" aria-labelledby="Search Questions" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="container-fluid">
                    <form action="{{ route('search') }}" method="get" class="search-bar ml-3">
                        <div class="d-flex align-items-center p-2">
                            <label class="m-0" for="search">
                                <i class="fas fa-search search-icon mr-2"></i>
                            </label>
                            <input id="searchInput" type="text" class="form-control border-0 search-input"
                                   name="q" placeholder="Search for questions" aria-label="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
