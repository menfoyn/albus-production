import Link from "next/link";
import Image from "next/image";

type Props = {
    title: string;
    subtitle: string;
    image: string;
    href: string;
};

export default function WorkCard({ title, subtitle, image, href }: Props) {
    return (
        <div className="relative rounded-[24px] bg-[#B33A1A] p-[48px] text-white">

            {/* Görsel */}
            <div className="relative h-[320px] w-full overflow-hidden rounded-[16px]">
                <Image
                    src={image}
                    alt={title}
                    fill
                    className="object-cover"
                />
            </div>

            {/* Yazılar */}
            <h3 className="mt-[32px] text-[40px] font-semibold leading-tight">
                {title}
            </h3>

            <p className="mt-[12px] text-[16px] opacity-80">
                {subtitle}
            </p>

            {/* OK */}
            <Link
                href={href}
                className="absolute bottom-[40px] right-[40px] flex h-[56px] w-[56px] items-center justify-center rounded-full border border-white/40 text-[24px] transition hover:border-white hover:bg-white/10"
                aria-label={`${title} detay`}
            >
                →
            </Link>
        </div>
    );
}