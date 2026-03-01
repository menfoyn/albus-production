"use client";

import Image from "next/image";
import Link from "next/link";
import { useState } from "react";

export default function ServicesHero() {
    const [openMenu, setOpenMenu] = useState(false);
    const BAR_H = 391; // Figma: 1440 x 391

    return (
        <section className="w-full overflow-hidden">
            {/* HEADER BAR */}
            <div className="relative w-full bg-[#120522]" style={{ height: `${BAR_H}px` }}>
                {/* vignette */}
                <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_35%_35%,rgba(0,0,0,0)_0%,rgba(0,0,0,0.18)_60%,rgba(0,0,0,0.45)_100%)]" />

                {/* LOGO */}
                <div className="absolute left-[123px] top-[58px] z-20">
                    <Link href="/" aria-label="ALBUS Home" className="block">
                        <Image
                            src="/images/footer/logo-white.png"
                            alt="ALBUS"
                            width={205}
                            height={49}
                            priority
                            className="h-[49px] w-[205px]"
                        />
                    </Link>
                </div>

                {/* Hamburger */}
                <button
                    onClick={() => setOpenMenu(true)}
                    className="absolute left-[123px] top-[215px] z-20 flex h-[34px] w-[68px] flex-col justify-between"
                    aria-label="Menu"
                    type="button"
                >
                    <span className="h-[3px] w-full bg-[#D9D9D9]" />
                    <span className="h-[3px] w-full bg-[#D9D9D9]" />
                    <span className="h-[3px] w-full bg-[#D9D9D9]" />
                </button>

                {/* Instagram */}
                <a
                    href="https://www.instagram.com/albusproduction/"                    target="_blank"
                    rel="noreferrer"
                    className="absolute right-[123px] top-[233px] z-20 font-[Rubik] text-[14px] font-light tracking-[0.04em] text-[#D9D9D9]/70 hover:text-[#D9D9D9]"
                >
                    Instagram ↗
                </a>
            </div>

            {/* MENU OVERLAY */}
            {openMenu && (
                <div className="fixed inset-0 z-[999] bg-[#120522]/95">
                    <button
                        onClick={() => setOpenMenu(false)}
                        className="absolute left-[125px] top-[106px] text-5xl text-white/70 hover:text-white"
                        aria-label="Close"
                        type="button"
                    >
                        ×
                    </button>

                    <div className="absolute left-40 top-40 text-white">
                        <div className="space-y-8 text-[64px] font-semibold leading-none">
                            <Link onClick={() => setOpenMenu(false)} href="/#work" className="block text-white/90 hover:text-white">
                                Portfolyo
                            </Link>
                            <Link onClick={() => setOpenMenu(false)} href="/services" className="block text-white/50 hover:text-white/90">
                                Hizmetlerimiz
                            </Link>
                            <Link onClick={() => setOpenMenu(false)} href="/about" className="block text-white/50 hover:text-white/90">
                                Biz Kimiz
                            </Link>
                        </div>
                    </div>
                </div>
            )}
        </section>
    );
}