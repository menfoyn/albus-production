"use client";

import Image from "next/image";

type Props = {
    src: string;
    alt: string;
    className?: string;
};

/**
 * Services sayfasındaki tüm görseller:
 * - Ortada
 * - Sabit genişlik
 */
export default function ServiceImage({ src, alt, className = "" }: Props) {
    const W = 780;
    const H = 332; // senin ServiceBlock'taki ölçüyle aynı yaptım

    return (
        <section className="w-full bg-white">
            <div className="mx-auto max-w-[1440px] px-[123px]">
                <div className={`mx-auto pt-[40px] ${className}`} style={{ width: `${W}px` }}>
                    <div className="relative overflow-hidden bg-black" style={{ width: `${W}px`, height: `${H}px` }}>
                        <Image src={src} alt={alt} fill className="object-cover" priority={false} />
                    </div>
                </div>
            </div>
        </section>
    );
}