<div class="container formBlock">
    <video class="formVideo" autoplay muted loop playsinline
        data-src="{{ asset('images/video/form-video.webm') }}" preload="none">
        <source type="video/webm">
        Ваш браузер не поддерживает видео.
    </video>
    <div class="formWrapper glass">
        <h2 class="subTitle">Запишитесь на полет на параплане сегодня</h2>
        <p class="text">Заполните форму и мы свяжемся с Вами в ближайшее время!</p>
        <form action="{{ url('/thanks') }}" method="POST" class="contactForm">
            @csrf
            <div class="formRow">
                <input type="text" id="name" name="name" required placeholder="Ваше имя">
            </div>
            <div class="formRow">
                <input type="tel" id="phone" name="phone" required placeholder="+7 (___) ___-__-__">
            </div>
            <div class="formRow formCheckbox">
                <input type="checkbox" id="consent" name="consent" required>
                <label for="consent">Я даю согласие на обработку персональных данных</label>
            </div>
            <div class="formRow">
                <button type="submit" class="button">Отправить</button>
            </div>
        </form>
    </div>
</div>
