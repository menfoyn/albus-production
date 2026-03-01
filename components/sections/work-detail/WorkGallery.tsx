"use client";

import Image from "next/image";
import { useEffect, useMemo, useRef, useState } from "react";

type WorkGalleryProps = {
  images: string[];
};

export default function WorkGallery({ images }: WorkGalleryProps) {
  const safeImages = useMemo(() => images?.filter(Boolean) ?? [], [images]);

  const [activeIndex, setActiveIndex] = useState(0);
  const [open, setOpen] = useState(false);

  // swipe support
  const touchStartX = useRef<number | null>(null);

  const clampIndex = (i: number) => {
    if (safeImages.length === 0) return 0;
    return (i + safeImages.length) % safeImages.length;
  };

  const openAt = (i: number) => {
    setActiveIndex(clampIndex(i));
    setOpen(true);
  };

  const next = () => setActiveIndex((i) => clampIndex(i + 1));
  const prev = () => setActiveIndex((i) => clampIndex(i - 1));
  const close = () => setOpen(false);

  useEffect(() => {
    if (!open) return;

    const onKeyDown = (e: KeyboardEvent) => {
      if (e.key === "Escape") close();
      if (e.key === "ArrowRight") next();
      if (e.key === "ArrowLeft") prev();
    };

    window.addEventListener("keydown", onKeyDown);
    return () => window.removeEventListener("keydown", onKeyDown);
  }, [open]);

  return (
    <section className="w-full bg-white">
      <div className="mx-auto max-w-[1440px] px-[83px] pb-[20px]">
        {/* Match WorkIntro grid so gallery starts from the right column (video end) */}
        <div className="grid grid-cols-[452px_1fr] gap-x-[165px]">
          {/* Left column placeholder (aligns with video column above) */}
          <div />

          {/* Right column (starts after 452px + 165px gap) */}
          <div className="w-full max-w-[664px] mt-[-30px]">
            {/* Gallery label (left-aligned, like Figma) */}
            <div className="mb-[28px] flex w-full items-center justify-start gap-[8px]">
              <svg aria-hidden width="14" height="14" viewBox="0 0 14 14" className="shrink-0">
                <path d="M12.5 1.5 L1.5 12.5" stroke="#C41027" strokeWidth="1.5" fill="none" />
                <path d="M5.0 12.5 H1.5 V9.0" stroke="#C41027" strokeWidth="1.5" fill="none" />
              </svg>
              <span className="font-[Rubik] text-[16px] font-normal tracking-[0.04em] text-[#C41027]">Galeri</span>
            </div>

            {/* Thumbnails (Figma: 165x177) – keep in one row, aligned to the left */}
            <div className="flex items-start justify-start gap-[24px] mt-[20px]">
              {safeImages.slice(0, 4).map((img, index) => (
                <button
                  key={img}
                  onClick={() => openAt(index)}
                  className="group relative h-[177px] w-[165px] flex-none overflow-hidden bg-black"
                  type="button"
                  aria-label={`Galeri ${index + 1}`}
                >
                  <Image
                    src={img}
                    alt={`Galeri ${index + 1}`}
                    fill
                    className="object-cover transition-transform duration-300 group-hover:scale-[1.03]"
                  />
                </button>
              ))}
            </div>
          </div>
        </div>
      </div>

      {/* LIGHTBOX */}
      {open && safeImages.length > 0 && (
        <div
          className="fixed inset-0 z-[999] bg-black/80"
          onClick={close}
          role="dialog"
          aria-modal="true"
        >
          {/* stop click bubbling so image area doesn't close */}
          <div
            className="absolute left-1/2 top-1/2 w-[92vw] max-w-[1100px] -translate-x-1/2 -translate-y-1/2"
            onClick={(e) => e.stopPropagation()}
            onTouchStart={(e) => {
              touchStartX.current = e.touches?.[0]?.clientX ?? null;
            }}
            onTouchEnd={(e) => {
              const startX = touchStartX.current;
              const endX = e.changedTouches?.[0]?.clientX ?? null;
              touchStartX.current = null;
              if (startX == null || endX == null) return;
              const dx = endX - startX;
              if (Math.abs(dx) < 40) return;
              if (dx < 0) next();
              else prev();
            }}
          >
            <div className="relative h-[70vh] w-full overflow-hidden rounded-[16px] bg-black">
              <Image
                src={safeImages[activeIndex]}
                alt={`Galeri büyük ${activeIndex + 1}`}
                fill
                className="object-contain"
                priority
              />
            </div>

            {/* Controls */}
            <button
              onClick={close}
              className="absolute -top-[52px] right-0 text-[40px] font-light text-white/80 hover:text-white"
              aria-label="Kapat"
              type="button"
            >
              ×
            </button>

            <button
              onClick={prev}
              className="absolute left-[-56px] top-1/2 -translate-y-1/2 rounded-full bg-white/10 px-4 py-3 text-[28px] text-white/90 hover:bg-white/20"
              aria-label="Önceki"
              type="button"
            >
              ‹
            </button>

            <button
              onClick={next}
              className="absolute right-[-56px] top-1/2 -translate-y-1/2 rounded-full bg-white/10 px-4 py-3 text-[28px] text-white/90 hover:bg-white/20"
              aria-label="Sonraki"
              type="button"
            >
              ›
            </button>

            {/* Index */}
            <div className="mt-[14px] flex items-center justify-center font-[Rubik] text-[14px] tracking-[0.04em] text-white/70">
              {activeIndex + 1} / {safeImages.length}
            </div>
          </div>
        </div>
      )}
    </section>
  );
}