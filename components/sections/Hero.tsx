"use client";
import Image from "next/image";
import { useEffect, useState } from "react";

export default function Hero() {
  const [menuOpen, setMenuOpen] = useState(false);

  useEffect(() => {
    if (!menuOpen) return;
    const prev = document.body.style.overflow;
    document.body.style.overflow = "hidden";
    return () => {
      document.body.style.overflow = prev;
    };
  }, [menuOpen]);

  return (
      <section className="relative z-50 w-full">
        {/* HERO AREA */}
        <div className="relative h-screen w-full overflow-hidden">
          {/* BACKGROUND VIDEO */}
          <video
            className="absolute inset-0 h-full w-full object-cover"
            src="/videos/hero.mp4"
            autoPlay
            muted
            loop
            playsInline
            preload="auto"
          />

          {/* DARK OVERLAY */}
          <div className="absolute inset-0 bg-black/55" />

          {/* FULLSCREEN MENU OVERLAY */}
          <div
            id="hero-menu"
            className={
              "fixed inset-0 z-[60] transition-all duration-300 " +
              (menuOpen ? "pointer-events-auto opacity-100" : "pointer-events-none opacity-0")
            }
            aria-hidden={!menuOpen}
          >
            {/* Backdrop */}
            <div
              className={
                "absolute inset-0 bg-[#120522] transition-opacity duration-300 " +
                (menuOpen ? "opacity-95" : "opacity-0")
              }
              onClick={() => setMenuOpen(false)}
            />

            {/* Content */}
            <div
              className={
                "relative h-full w-full transition-transform duration-300 " +
                (menuOpen ? "translate-x-0" : "-translate-x-6")
              }
              role="dialog"
              aria-modal="true"
              aria-label="Site menüsü"
              onKeyDown={(e) => {
                if (e.key === "Escape") setMenuOpen(false);
              }}
              tabIndex={-1}
            >
              {/* Logo (same position as hero) */}
              <div className="absolute left-[125px] top-[106px]">
                <Image
                  src="/images/footer/logo-white.png"
                  alt="Albus Production Logo"
                  width={205}
                  height={49}
                  priority
                />
              </div>

              {/* Close button */}
              <button
                type="button"
                onClick={() => setMenuOpen(false)}
                aria-label="Menüyü kapat"
                className="absolute left-[125px] top-[260px] flex h-14 w-14 items-center justify-center rounded-full text-white/70 hover:text-white"
              >
                <span className="relative block h-8 w-8">
                  <span className="absolute left-1/2 top-1/2 h-[2px] w-8 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-white/40" />
                  <span className="absolute left-1/2 top-1/2 h-[2px] w-8 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-white/40" />
                </span>
              </button>

              {/* Menu items */}
              <nav className="absolute left-[240px] top-[260px]">
                <ul className="space-y-8">
                  <li>
                    <a
                      href="/works"
                      onClick={() => setMenuOpen(false)}
                      className="block text-[56px] font-semibold tracking-tight text-white/90 hover:text-white"
                    >
                      Portfolyo
                    </a>
                  </li>
                  <li>
                    <a
                      href="/services"
                      onClick={() => setMenuOpen(false)}
                      className="block text-[56px] font-medium tracking-tight text-white/55 hover:text-white/80"
                    >
                      Hizmetlerimiz
                    </a>
                  </li>
                  <li>
                    <a
                      href="/about"
                      onClick={() => setMenuOpen(false)}
                      className="block text-[56px] font-medium tracking-tight text-white/55 hover:text-white/80"
                    >
                      Biz Kimiz
                    </a>
                  </li>
                </ul>
              </nav>

              {/* Bottom info bar (kept like figma) */}
              <div className="absolute bottom-0 left-0 w-full bg-[#120522]">
                <div className="mx-auto flex max-w-6xl items-center justify-between gap-10 px-6 py-10 text-white/70">
                  <div className="min-w-[140px] text-sm text-white/60">Biz Kimiz?</div>
                  <div className="flex flex-1 items-start gap-8">
                    <div className="h-16 w-px bg-white/20" />
                    <p className="max-w-3xl text-sm leading-7 text-white/65">
                      Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde; ileri teknoloji ile yaratıcı prodüksiyon çözümleri sunan profesyonel bir ekibiz.
                    </p>
                  </div>
                  <a
                      href="https://www.instagram.com/albusproduction/"                    target="_blank"
                    rel="noreferrer"
                    className="text-sm text-white/60 hover:text-white"
                  >
                    Instagram ↗
                  </a>
                </div>
              </div>
            </div>
          </div>

          {/* LOGO (FIGMA: 205x49, top:106, left:125) */}
          <div className="absolute left-[125px] top-[106px] z-20">
            <Image
                src="/images/footer/logo-white.png"
                alt="Albus Production Logo"
                width={205}
                height={49}
                priority
            />
          </div>

          {/* HAMBURGER (FIGMA STYLE) */}
          <button
            type="button"
            onClick={() => setMenuOpen((v) => !v)}
            aria-label="Menüyü aç"
            aria-expanded={menuOpen}
            aria-controls="hero-menu"
            className="absolute left-[125px] top-[291px] z-20 flex h-[34px] w-[68px] flex-col items-start justify-center gap-[10px]"
            style={{ filter: "drop-shadow(0px 6px 10px rgba(0,0,0,0.35))" }}
          >
            <span className="block h-[3px] w-[68px] rounded-full" style={{ backgroundColor: "rgba(255,255,255,0.7)" }} />
            <span className="block h-[3px] w-[68px] rounded-full" style={{ backgroundColor: "rgba(255,255,255,0.7)" }} />
            <span className="block h-[3px] w-[68px] rounded-full" style={{ backgroundColor: "rgba(255,255,255,0.7)" }} />
          </button>

          {/* PURPLE INFO BAR */}
          <div className="absolute bottom-0 left-0 w-full bg-[#120522]">
            <div className="mx-auto flex max-w-6xl items-center justify-between gap-10 px-6 py-10 text-white/70">
              {/* LEFT */}
              <div className="min-w-[140px] text-sm text-white/60">
                Biz Kimiz?
              </div>

              {/* CENTER */}
              <div className="flex flex-1 items-start gap-8">
                <div className="h-16 w-px bg-white/20" />
                <p className="max-w-3xl text-sm leading-7 text-white/65">
                  Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde; ileri
                  teknoloji ile yaratıcı prodüksiyon çözümleri sunan profesyonel
                  bir ekibiz.
                </p>
              </div>

              {/* RIGHT */}
              <a
                  href="https://www.instagram.com/albusproduction/"                  target="_blank"
                  rel="noreferrer"
                  className="text-sm text-white/60 hover:text-white"
              >
                Instagram ↗
              </a>
            </div>
          </div>
        </div>
      </section>
  );
}