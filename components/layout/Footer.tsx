"use client";

import Image from "next/image";
import { useState } from "react";
import ProjectRequestModal from "@/components/modals/ProjectRequestModal";

export default function Footer() {
    const [open, setOpen] = useState(false);

    return (
        <>
            <footer id="contact" className="relative w-full bg-black">
                <div className="relative h-[900px] w-full">
                    {/* Background image (senin yolun) */}
                    <Image
                        src="/images/footer/footer-bg.jpg"
                        alt="Albus Footer Background"
                        fill
                        priority
                        className="object-cover"
                    />

                    {/* Dark overlay */}
                    <div className="absolute inset-0 bg-black/55" />

                    {/* Content */}
                    <div className="absolute inset-0">
                        <div className="mx-auto flex h-full w-full max-w-[1440px] flex-col px-10 pt-14">
                            {/* Logo */}
                            <div className="flex justify-center">
                                <Image
                                    src="/images/footer/logo-white.png"
                                    alt="Albus"
                                    width={227}
                                    height={55}
                                    priority
                                />
                            </div>

                            <div className="mt-16 grid grid-cols-[1fr_auto_1fr] items-start gap-10">
                                {/* Left */}
                                <div className="space-y-8 text-white/80">
                                    <a
                                        href="mailto:info@albusproduction.com"
                                        className="inline-flex items-center gap-3 hover:text-white"
                                    >
                                        info@albusproduction.com <span className="text-white/60">↗</span>
                                    </a>

                                    <a
                                        href="https://www.instagram.com/albusproduction/"                                        target="_blank"
                                        rel="noreferrer"
                                        className="inline-flex items-center gap-3 hover:text-white"
                                    >
                                        Instagram <span className="text-white/60">↗</span>
                                    </a>

                                    <p className="max-w-[520px] text-sm leading-6 text-white/55">
                                        Orucreis Mah. Tekstilkent Cad. Tekstilkent GD3 Blok No:10AG,
                                        <br />
                                        İç Kapı No:Z12, 34235, Esenler/İstanbul
                                    </p>
                                </div>

                                {/* Center line */}
                                <div className="flex h-[220px] w-[1px] justify-center bg-white/20" />

                                {/* Right */}
                                <div className="flex justify-end">
                                    <button
                                        onClick={() => setOpen(true)}
                                        className="group relative flex h-[90px] w-[320px] items-center justify-between rounded-[18px] border border-white/20 bg-white/5 px-7 text-left text-white/70 backdrop-blur-md transition hover:bg-white/10 hover:text-white"
                                    >
                                        <div className="leading-6">
                                            <div className="text-sm text-white/60">Proje Talebi</div>
                                            <div className="text-lg">Oluştur</div>
                                        </div>

                                        <div className="flex h-12 w-12 items-center justify-center rounded-full border border-white/20 text-white/70 transition group-hover:text-white">
                                            →
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div className="flex-1" />
                        </div>
                    </div>
                </div>
            </footer>

            <ProjectRequestModal open={open} onClose={() => setOpen(false)} />
        </>
    );
}