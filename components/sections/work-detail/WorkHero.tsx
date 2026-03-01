"use client";

import Image from "next/image";
import { useState } from "react";

type Props = {
  /** Fullscreen hero background image (e.g. /images/works/turk-telekom/1.jpg) */
  backgroundImage: string;
  /** Video file to play in the modal (e.g. /videos/turk-telekom.mp4) */
  videoSrc: string;

  /** Optional overrides (defaults preserve Turk Telekom look) */
  barHeight?: number; // default 120
  barColor?: string; // default "#120522"
  contentPaddingX?: number; // default 101

  logoLeft?: number; // default 220
  logoTop?: number; // default 60

  menuLeft?: number; // default 660
  menuTop?: number; // default 106

  /** next/image object-position value, e.g. "78% 55%" */
  imageObjectPosition?: string; // default "78% 55%"
};

export default function WorkHero({
  backgroundImage,
  videoSrc,
  barHeight = 120,
  barColor = "#120522",
  contentPaddingX = 101,
  logoLeft = 220,
  logoTop = 60,
  menuLeft = 660,
  menuTop = 106,
  imageObjectPosition = "78% 55%",
}: Props) {
  const [openVideo, setOpenVideo] = useState(false);
  const [openMenu, setOpenMenu] = useState(false);
  const BAR_H = barHeight; // slightly narrower than the 181px Figma bar

  return (
    <section className="w-full bg-black overflow-hidden">
      <div className="relative w-full overflow-hidden bg-black">
        {/* HERO (fits viewport: image area + 181px bottom bar) */}
        <div className="flex h-screen w-full flex-col bg-black">
          {/* IMAGE AREA (takes remaining height, so bottom bar is always visible) */}
          <div className="relative w-full overflow-hidden bg-black" style={{ height: `calc(100vh - ${BAR_H}px)` }}>
            <Image
              src={backgroundImage}
              alt="Hero"
              fill
              priority
              quality={100}
              sizes="100vw"
              className="object-cover"
              style={{ objectPosition: imageObjectPosition }}
            />

            {/* soft vignette */}
            <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_35%_35%,rgba(0,0,0,0)_0%,rgba(0,0,0,0.18)_60%,rgba(0,0,0,0.45)_100%)]" />

            {/* Logo (Figma approx: 205 x 49, left: 125, top: 106) */}
            <div className="absolute z-20" style={{ left: logoLeft, top: logoTop }}>
              <a href="/" aria-label="ALBUS Home" className="block">
                <Image
                  src="/images/footer/logo-white.png"
                  alt="ALBUS"
                  width={205}
                  height={49}
                  priority
                  className="h-[49px] w-[205px]"
                />
              </a>
            </div>

            {/* Hamburger (Figma: 68 x 34, left: 619, top: 106) */}
            <button
              onClick={() => setOpenMenu(true)}
              className="absolute z-20 flex h-[34px] w-[68px] flex-col justify-between"
              style={{ left: menuLeft, top: menuTop }}
              aria-label="Menu"
              type="button"
            >
              <span className="h-[3px] w-full bg-white" />
              <span className="h-[3px] w-full bg-white" />
              <span className="h-[3px] w-full bg-white" />
            </button>
          </div>

          {/* Bottom bar (target: slightly narrower than Figma, still full width) */}
          <div className="z-20 w-full" style={{ height: `${BAR_H}px`, backgroundColor: barColor }}>
            <div className="flex h-full w-full items-center" style={{ paddingLeft: contentPaddingX, paddingRight: contentPaddingX }}>
              <button
                onClick={() => setOpenVideo(true)}
                type="button"
                className="inline-flex items-center justify-center font-[Rubik] text-[24px] font-light leading-none tracking-normal text-[#D9D9D9]"
              >
                Tanıtımı izle ↘
              </button>
            </div>
          </div>
        </div>
      </div>

      {/* MENU OVERLAY */}
      {openMenu && (
        <div className="fixed inset-0 z-[999] bg-[#120522]/95">
          <button
            onClick={() => setOpenMenu(false)}
            className="absolute left-[125px] top-[106px] text-5xl text-white/70"
            aria-label="Close"
            type="button"
          >
            ×
          </button>

          <div className="absolute left-40 top-40 text-white">
            <div className="space-y-8 text-[64px] font-semibold leading-none">
              <a href="/#work" className="block text-white/90 hover:text-white">
                Portfolyo
              </a>
              <a href="/#services" className="block text-white/50 hover:text-white/90">
                Hizmetlerimiz
              </a>
              <a href="/#about" className="block text-white/50 hover:text-white/90">
                Biz Kimiz
              </a>
            </div>
          </div>
        </div>
      )}

      {/* VIDEO MODAL */}
      {openVideo && (
        <div className="fixed inset-0 z-[999] bg-black/80">
          <button
            onClick={() => setOpenVideo(false)}
            className="absolute right-10 top-8 text-4xl text-white/80"
            aria-label="Close video"
            type="button"
          >
            ×
          </button>

          {/* Figma video: 452 x 803 (keep, but make responsive) */}
          <div className="absolute left-1/2 top-1/2 h-[803px] w-[452px] max-h-[90vh] max-w-[90vw] -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-xl bg-black">
            <video src={videoSrc} controls autoPlay className="h-full w-full object-cover" />
          </div>
        </div>
      )}
      {/* close max-w container */}
    </section>
  );
}