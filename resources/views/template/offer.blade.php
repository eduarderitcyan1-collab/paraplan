<div class="container offer">
    <h2 class="subTitle">Летать с нами - выгодно отдыхать!</h2>
    <p class="text">После полета вы получаете скидки на услуги наших партнеров!</p>
    <div class="offerWrapper">
        @foreach ($offers as $offer)
            <div class="offerItem">
                <div class="offerPhotoWrapper">
                    <img src="{{ asset('storage/' . $offer->img) }}" alt="Offer Photo" class="offerPhoto">
                </div>
                <div class="offerTitle">{{ $offer->title }}</div>
                <div class="offerPrice">скидка {{ $offer->desc }}%</div>
            </div>
        @endforeach
    </div>
</div>
