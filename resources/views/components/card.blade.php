<div class="card {{ $class ?? '' }}" style="width: {{ $width ?? '18rem' }};">
  @if (!empty($image))
    <img src="{{ $image }}" class="card-img-top" alt="{{ $title ?? 'Card image' }}">
  @endif

  <div class="card-body">
    @isset($title)
      <h5 class="card-title">{{ $title }}</h5>
    @endisset

    @isset($text)
      <p class="card-text">{{ $text }}</p>
    @endisset

    @isset($link)
      <a href="{{ $link }}" class="btn btn-primary">{{ $linkText ?? 'Read more' }}</a>
    @endisset
  </div>
</div>
