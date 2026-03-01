"use client";

import Image from "next/image";
import Link from "next/link";

type Item = {
    title: string;
    image: string;
    href: string;
    variant: "large" | "small" | "tall";
};

type Props = {
    items: Item[];
};

export default function RelatedWorks({ items }: Props) {
    return (
        <section className="w-full bg-white py-[160px]">
            <div className="mx-auto max-w-[1440px] px-[83px]">

                {/* TITLE */}
                <div className="mb-[72px] flex items-start gap-[18px]">
                    <div className="h-[88px] w-[2px] bg-[#C41027]" />
                    <div>
                        <h2 className="font-[Rubik] text-[36px] font-semibold leading-[1.2] text-[#C41027]">
                            Diğer<br />İşlerimize<br />Göz Atın
                        </h2>
                        <span className="mt-[12px] inline-block text-[#C41027] text-[28px]">
              ↘
            </span>
                    </div>
                </div>

                {/* CARDS */}
                <div className="grid grid-cols-3 items-start gap-[48px]">
                    {items.map((item, i) => (
                        <Link
                            key={i}
                            href={item.href}
                            className="group block"
                        >
                            <div
                                className={`
                  relative overflow-hidden bg-black
                  ${item.variant === "large" && "h-[314px]"}
                  ${item.variant === "small" && "h-[224px] "}
                  ${item.variant === "tall" && "h-[492px]"}
                `}
                            >
                                <Image
                                    src={item.image}
                                    alt={item.title}
                                    fill
                                    className="object-cover transition-transform duration-500 group-hover:scale-[1.04]"
                                />

                                {/* LABEL */}
                                <div className="absolute bottom-[16px] left-[16px]">
                  <span className="font-[Rubik] text-[14px] tracking-[0.08em] text-white">
                    {item.title}
                  </span>
                                </div>
                            </div>
                        </Link>
                    ))}
                </div>

            </div>
        </section>
    );
}