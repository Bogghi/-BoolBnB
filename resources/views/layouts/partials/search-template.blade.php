<script id="search-result-template" type="text/x-handlebars-template">

    <div class="apartment-card" data-aos="fade-right" data-aos-anchor=".navbar" data-aos-delay="@{{delay}}">
        <div class="image-wrapper">
          @{{#if asset}}
            <img src="storage/@{{cover_image}}" alt="immagine casa">
          @{{else}}
            <img src="@{{cover_image}}" alt="immagine casa">
          @{{/if}}
        </div>
        <div class="info-wrapper">
            <div class="main">
                <div class="title">
                    <h5>@{{title}}</h5>
                    <input type="hidden" value="@{{id}}" class="apartment-id">
                </div>
                <div class="address">
                    <p>@{{address}}</p>
                </div>
                <input type="hidden" value="@{{longitude}}" class="apartment-lon">
                <input type="hidden" value="@{{latitude}}" class="apartment-lat">
            </div>
            <ul>
                <li>
                    <strong>Rooms:</strong> @{{rooms_number}}
                </li>
                <li>
                    <strong>Bathrooms:</strong> @{{bathrooms_number}}
                </li>
                <li>
                    <strong>Beds:</strong> @{{beds_number}}
                </li>
                <li>
                    <strong>m&sup2;:</strong> @{{square_meters}}
                </li>
            </ul>
        </div>
        @{{#if sponsorized}}
            <div class="button-wrapper space-between">
                <div class="badge">Superhost</div>
                <a href="http://localhost:8000/show/@{{id}}" class="btn-details">Details</a>
            </div>
        @{{else}}
            <div class="button-wrapper flex-end">
                <a href="http://localhost:8000/show/@{{id}}" class="btn-details">Details</a>
            </div>
        @{{/if}}
    </div>

</script>
