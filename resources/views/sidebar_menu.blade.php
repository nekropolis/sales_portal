<div class="accordion" id="mainMenu">
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseOne">
                <span><i class="bi bi-receipt"></i> Каталог</span>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
             aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('products') }}"> Продукты </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('brands') }}"> Бренды </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories') }}"> Категории </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sellers') }}"> Наценка </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sellers') }}"> Валюты </a>
                    </li>
                @endauth
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseTwo">
                <span><i class="bi bi-people"></i> Покупатели</span>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
             aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
                <i class="bi bi-people"></i>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseThree">
                <span><i class="bi bi-truck"></i> Поставщики</span>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
             aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('uploadedPrices') }}"> Прайс лист </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sellers') }}"> Поставщики</a>
                    </li>
                @endauth
            </div>
        </div>
    </div>
</div>
