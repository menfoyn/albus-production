"use client";

import Image from "next/image";
import Link from "next/link";
import { usePathname } from "next/navigation";
import { useMemo, useState } from "react";

export default function HeaderBar() {
    const [openMenu, setOpenMenu] = useState(false);

    // Figma: 1440 x 391
    const BAR_H = 391;

    const pathname = usePathname();
    const active = useMemo(() => {
        if (!pathname) return "";
        if (pathname.startsWith("/works")) return "works";
        if (pathname.startsWith("/services")) return "services";
        if (pathname.startsWith("/about")) return "about";
        return "";
    }, [pathname]);

    return (
        <header className="relative w-full overflow-hidden">
            {/* LOGO - her zaman üstte (overlay açıkken de görünür) */}
            <div className="absolute left-[123px] top-[58px] z-[1001]">
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

            {/* HEADER BAR */}
            <div className="relative w-full bg-[#120522]" style={{ height: `${BAR_H}px` }}>
                {/* vignette */}
                <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_35%_35%,rgba(0,0,0,0)_0%,rgba(0,0,0,0.18)_60%,rgba(0,0,0,0.45)_100%)]" />

                {/* Hamburger (68x34) */}
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
                    href="https://www.instagram.com/albusproduction/"
                    target="_blank"
                    rel="noreferrer"
                    className="absolute right-[123px] top-[233px] z-20 font-[Rubik] text-[14px] font-light tracking-[0.04em] text-[#D9D9D9]/70 hover:text-[#D9D9D9]"
                >
                    Instagram ↗
                </a>
            </div>

            {/* MENU OVERLAY (Figma: Desktop-3) */}
            {openMenu && (
                <div className="fixed inset-0 z-[999] bg-[#120522]/95">
                    {/* Close (X) */}
                    <button
                        onClick={() => setOpenMenu(false)}
                        className="absolute left-[137px] top-[275.9px] h-[52.1px] w-[44px] text-[56px] leading-none text-[#7B7D97] hover:text-[#D9D9D9]"
                        aria-label="Close"
                        type="button"
                    >
                        ×
                    </button>

                    {/* Main nav (Figma boxes: 459x97) */}
                    <nav className="absolute left-[292px] top-[250px]">
                        <div className="flex flex-col font-[Rubik] leading-[1]">
                            <Link
                                href="/works"
                                onClick={() => setOpenMenu(false)}
                                className={`block h-[97px] w-[459px] text-[64px] transition-colors ${
                                    active === "works"
                                        ? "text-[#D9D9D9] tracking-[0.02em]"
                                        : "text-[#7B7D97] tracking-[0] hover:text-[#D9D9D9]"
                                }`}
                                style={{ fontWeight: active === "works" ? 738 : 454 }}
                            >
                                Portfolyo
                            </Link>

                            <Link
                                href="/services"
                                onClick={() => setOpenMenu(false)}
                                className={`block h-[97px] w-[459px] text-[64px] transition-colors ${
                                    active === "services"
                                        ? "text-[#D9D9D9] tracking-[0.02em]"
                                        : "text-[#7B7D97] tracking-[0] hover:text-[#D9D9D9]"
                                }`}
                                style={{ fontWeight: active === "services" ? 738 : 454 }}
                            >
                                Hizmetlerimiz
                            </Link>

                            <Link
                                href="/about"
                                onClick={() => setOpenMenu(false)}
                                className={`block h-[97px] w-[459px] text-[64px] transition-colors ${
                                    active === "about"
                                        ? "text-[#D9D9D9] tracking-[0.02em]"
                                        : "text-[#7B7D97] tracking-[0] hover:text-[#D9D9D9]"
                                }`}
                                style={{ fontWeight: active === "about" ? 738 : 454 }}
                            >
                                Biz Kimiz
                            </Link>
                        </div>
                    </nav>

                    {/* Bottom info row */}
                    <div className="absolute bottom-[64px] left-[123px] right-[123px] flex items-end justify-between">
                        <div className="flex items-end gap-[22px]">
                            <div className="font-[Rubik] text-[14px] font-light tracking-[0.04em] text-[#D9D9D9]/70">
                                Biz Kimiz?
                            </div>

                            <div className="h-[52px] w-[1px] bg-[#D9D9D9]/30" />

                            <p
                                className="w-[453px] font-[Rubik] text-[14px] font-light leading-[1.3] tracking-[0.06em] text-[#D9D9D9]/70"
                                style={{ fontWeight: 300 }}
                            >
                                Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde; ileri teknoloji ile yaratıcı prodüksiyon çözümleri
                                sunan profesyonel bir ekibiz.
                            </p>
                        </div>

                        <a
                            href="https://www.instagram.com/albusproduction/"
                            target="_blank"
                            rel="noreferrer"
                            className="font-[Rubik] text-[14px] font-light tracking-[0.04em] text-[#D9D9D9]/70 hover:text-[#D9D9D9]"
                        >
                            Instagram ↗
                        </a>
                    </div>
                </div>
            )}
        </header>
    );
}