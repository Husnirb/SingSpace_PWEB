@props(['judul', 'nilai', 'ikon', 'warna' => 'var(--text-white)'])

<div class="stat-box" style="border-color: {{ $warna === 'var(--text-white)' ? 'var(--border-color)' : $warna }};">
    <span class="stat-value" style="color: {{ $warna }}; display: flex; align-items: center; justify-content: center; gap: 8px;">
        <span style="font-size: 1.2rem;">{!! $ikon !!}</span>
        <span id="stat{{ str_replace([' ', '/'], '', $judul) }}">{{ $nilai }}</span>
    </span>
    <span class="stat-label">{{ $judul }}</span>
</div>
