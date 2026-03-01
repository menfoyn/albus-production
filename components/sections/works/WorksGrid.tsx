"use client";

import Image from "next/image";
import Link from "next/link";
import { useSearchParams } from "next/navigation";
import { works } from "@/lib/works"; // <-- senin dosyandaki export ismi bu değilse düzelt

export default function WorksGrid() {
    const searchParams = useSearchParams();
    const active = searchParams.get("cat") ?? "all";

    const filtered = active === "all" ? works : works.filter((w) => w.category === active);

    return (
        <section className="w-full bg-white">
            <div className="mx-auto max-w-[1440px] px-[123px] pb-[110px]">
                {/* 2 sütun grid (senin görsele uygun) */}
                <div className="grid grid-cols-2 gap-x-[34px] gap-y-[34px]">
                    {filtered.map((w) => (
                        <Link key={w.slug} href={`/works/${w.slug}`} className="group block">
                            <div className="relative h-[450px] w-[578px] overflow-hidden bg-black">
                                <Image
                                    src={w.cover}
                                    alt={w.title}
                                    fill
                                    className="object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                                />
                                {/* alttaki label */}
                                <div className="absolute bottom-[18px] left-[22px] font-[Rubik] text-[12px] tracking-[0.12em] text-white/75">
                                    {w.title.toUpperCase()}
                                </div>
                            </div>
                        </Link>
                    ))}
                </div>
            </div>
        </section>
    );
}