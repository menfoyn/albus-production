"use client";

import { usePathname, useRouter, useSearchParams } from "next/navigation";

const tabs = [
    { key: "all", label: "Tüm İşler" },
    { key: "konser", label: "Konser & Festival & Tiyatro" },
    { key: "toplanti", label: "Toplantı & Konferans" },
    { key: "lansman", label: "Lansman & Gala & Sergi" },
    { key: "fuar", label: "Fuar & Stand Uygulamaları" },
];

export default function WorksTabs() {
    const router = useRouter();
    const pathname = usePathname();
    const searchParams = useSearchParams();

    const active = searchParams.get("cat") ?? "all";

    function go(key: string) {
        const p = new URLSearchParams(searchParams.toString());
        if (key === "all") p.delete("cat");
        else p.set("cat", key);

        const qs = p.toString();
        router.push(qs ? `${pathname}?${qs}` : pathname);
    }

    return (
        <section className="w-full bg-white">
            <div className="mx-auto max-w-[1440px] px-[123px]">
                {/* Figma gibi: ortada yatay tab bar */}
                <div className="flex items-center justify-center gap-[26px] py-[34px] text-[14px]">
                    {tabs.map((t, idx) => (
                        <div key={t.key} className="flex items-center">
                            <button
                                onClick={() => go(t.key)}
                                className={[
                                    "font-[Rubik] transition-colors",
                                    active === t.key ? "text-[#C41027]" : "text-[#BDBDBD] hover:text-[#6b6b6b]",
                                ].join(" ")}
                            >
                                {t.label}
                            </button>

                            {/* aradaki dikey ayraçlar */}
                            {idx !== tabs.length - 1 && (
                                <div className="mx-[26px] h-[28px] w-[1px] bg-[#E6E6E6]" />
                            )}
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}