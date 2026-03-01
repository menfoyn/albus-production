"use client";

import Image from "next/image";
import { useMemo, useState } from "react";
import {
  animate,
  motion,
  type PanInfo,
  useMotionValue,
  useTransform,
} from "framer-motion";

type ServiceItem = {
  title: string;
  desc: string;
  image: string;
};

const clamp = (n: number, min: number, max: number) =>
    Math.max(min, Math.min(max, n));
const mod = (n: number, m: number) => ((n % m) + m) % m;

export default function Services() {
  const services: ServiceItem[] = useMemo(
      () => [
        {
          title: "Prodüksiyon Yönetimi",
          desc: "Tüm prodüksiyon sürecini uçtan uca yöneterek yaratıcı ve sorunsuz bir deneyim sağlarız.",
          image: "/images/services/service-1.jpg",
        },
        {
          title: "LED & İçerik Tasarımı",
          desc: "LED ekranlar için içerik tasarımı ve sahne görsel diliyle güçlü bir hikaye anlatımı kurarız.",
          image: "/images/services/service-2.jpg",
        },
        {
          title: "3D Sahne Tasarımı",
          desc: "Etkinlik ve prodüksiyon süreçlerinde mekanın tüm dinamiklerini önceden görmenizi sağlayan profesyonel 3D sahne tasarımları oluşturuyoruz.",
          image: "/images/services/service-3.jpg",
        },
      ],
      []
  );

  const [active, setActive] = useState(0);
  const shift = useMotionValue(0);

  // Figma reference sizes
  const BASE_W = 454;
  const BASE_H = 559;
  const SMALL_W = 328;
  const SMALL_H = 404;

  const GAP = 36;

  const X0 = 0;
  const X1 = BASE_W + GAP;
  const X2 = X1 + SMALL_W + GAP;

  const X_LEFT = -(SMALL_W + GAP);
  const X_RIGHT = X2 + SMALL_W + GAP;

  const STAGE_W = X2 + SMALL_W * 0.55;

  function resetShift() {
    animate(shift, 0, { type: "spring", stiffness: 420, damping: 38 });
  }

  function settleToNext() {
    animate(shift, -1, {
      type: "spring",
      stiffness: 320,
      damping: 34,
      onComplete: () => {
        setActive((p) => mod(p + 1, services.length));
        shift.set(0);
      },
    });
  }

  function settleToPrev() {
    animate(shift, 1, {
      type: "spring",
      stiffness: 320,
      damping: 34,
      onComplete: () => {
        setActive((p) => mod(p - 1, services.length));
        shift.set(0);
      },
    });
  }

  function goNext() {
    shift.set(0);
    settleToNext();
  }

  function goPrev() {
    shift.set(0);
    settleToPrev();
  }

  function onDragEnd(_: MouseEvent | TouchEvent | PointerEvent, info: PanInfo) {
    const dx = info.offset.x;
    const vx = info.velocity.x;

    if (dx < -90 || vx < -650) settleToNext();
    else if (dx > 90 || vx > 650) settleToPrev();
    else resetShift();
  }

  const activeItem = services[active];

  const deck = ([-1, 0, 1, 2] as const).map((rel) => {
    const idx = mod(active + rel, services.length);
    return { rel, idx, item: services[idx] };
  });

  return (
      <section className="w-full bg-white overflow-x-hidden">
        {/* Figma Desktop width + exact left/right padding */}
        <div className="mx-auto w-full max-w-[1440px] px-6 lg:px-[123px]">
          {/* Header (Figma style: vertical line + 32px title, right link 20px) */}
          <div className="pt-[124px]">
            <div className="flex items-center justify-between">
              <div className="flex items-center gap-[16px]">
                <div className="h-[165px] w-[3px] bg-[#C41027]" />
                <div
                  className="font-[Rubik] text-[32px] font-normal text-[#C41027]"
                  style={{
                    lineHeight: "100%",
                    letterSpacing: "0%",
                  }}
                >
                  Hizmetlerimiz
                </div>
              </div>

              <a
                  href="/services"
                  className="mt-[4px] inline-flex items-center gap-3 font-[Rubik] text-[20px] font-normal leading-[1.3] tracking-[0.06em] text-[#C41027]"
              >
                Tüm Hizmetler <span aria-hidden>→</span>
              </a>
            </div>
          </div>

          {/* Content row */}
          <div className="mt-[90px] grid grid-cols-12 items-start gap-[60px] pb-28">
            {/* Left text (Figma-like) */}
            <div className="col-span-12 lg:col-span-4 lg:mt-[120px]">
              <div className="flex gap-[22px]">
                <div className="mt-[6px] h-[150px] w-[2px] bg-[#4C358C]" />
                <div className="min-w-0">
                  <h3 className="font-[Rubik] text-[20px] font-normal leading-[1.2] tracking-[0.02em] text-[#442D84]">
                    {activeItem.title}
                  </h3>

                  <p className="mt-[18px] max-w-[250px] font-[Rubik] text-[20px] font-light leading-[1.19] tracking-[0.04em] text-[#442D84]">
                    {activeItem.desc}
                  </p>

                  {/* Controls */}
                  <div className="mt-[34px] flex items-center gap-3">
                    <button
                        type="button"
                        onClick={goPrev}
                        className="h-11 w-11 rounded-full border border-black/20 text-black/60 hover:text-black/80"
                        aria-label="Önceki"
                    >
                      ←
                    </button>
                    <button
                        type="button"
                        onClick={goNext}
                        className="h-11 w-11 rounded-full border border-black/20 text-black/60 hover:text-black/80"
                        aria-label="Sonraki"
                    >
                      →
                    </button>
                  </div>
                </div>
              </div>
            </div>

            {/* Right gallery */}
            <div className="col-span-12 lg:col-span-8">
              <div className="relative w-full">
                <div
                    className="relative overflow-hidden"
                    style={{
                      height: BASE_H,
                      width: STAGE_W,
                    }}
                >
                  {[...deck]
                      .sort((a, b) => {
                        const order = (r: -1 | 0 | 1 | 2) =>
                            r === 2 ? 0 : r === 1 ? 1 : r === 0 ? 2 : 3;
                        return order(a.rel) - order(b.rel);
                      })
                      .map(({ item, rel, idx }) => (
                          <ServiceCard
                              key={`${idx}-${active}-${rel}`}
                              item={item}
                              rel={rel}
                              baseW={BASE_W}
                              baseH={BASE_H}
                              gap={GAP}
                              x0={X0}
                              x1={X1}
                              x2={X2}
                              xLeft={X_LEFT}
                              xRight={X_RIGHT}
                              shift={shift}
                              onDragEnd={onDragEnd}
                          />
                      ))}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  );
}

function ServiceCard({
                       item,
                       rel,
                       baseW,
                       baseH,
                       gap,
                       x0,
                       x1,
                       x2,
                       xLeft,
                       xRight,
                       shift,
                       onDragEnd,
                     }: {
  item: ServiceItem;
  rel: -1 | 0 | 1 | 2;
  baseW: number;
  baseH: number;
  gap: number;
  x0: number;
  x1: number;
  x2: number;
  xLeft: number;
  xRight: number;
  shift: ReturnType<typeof useMotionValue>;
  onDragEnd: (_: MouseEvent | TouchEvent | PointerEvent, info: PanInfo) => void;
}) {
  const isTop = rel === 0;

  const xNow = rel === -1 ? xLeft : rel === 0 ? x0 : rel === 1 ? x1 : x2;

  const xNext =
      rel === -1 ? xLeft : rel === 0 ? xLeft : rel === 1 ? x0 : rel === 2 ? x1 : x2;

  const xPrev =
      rel === -1 ? x0 : rel === 0 ? x1 : rel === 1 ? x2 : rel === 2 ? xRight : xRight;

  const x = useTransform(shift, [-1, 0, 1], [xNext, xNow, xPrev]);

  const wNow = rel === 0 ? baseW : 328;
  const hNow = rel === 0 ? baseH : 404;

  const wNext = rel === 1 ? baseW : 328;
  const hNext = rel === 1 ? baseH : 404;

  const wPrev = rel === -1 ? baseW : 328;
  const hPrev = rel === -1 ? baseH : 404;

  const width = useTransform(shift, [-1, 0, 1], [wNext, wNow, wPrev]);
  const height = useTransform(shift, [-1, 0, 1], [hNext, hNow, hPrev]);

  const SMALL_Y = baseH - 404;
  const yNow = rel === 0 ? 0 : SMALL_Y;
  const yNext = rel === 1 ? 0 : SMALL_Y;
  const yPrev = rel === -1 ? 0 : SMALL_Y;
  const y = useTransform(shift, [-1, 0, 1], [yNext, yNow, yPrev]);

  const zIndex =
      rel === 0
          ? useTransform(shift, [-1, 0, 1], [50, 60, 50])
          : rel === 1
              ? useTransform(shift, [-1, 0, 1], [70, 40, 40])
              : rel === -1
                  ? useTransform(shift, [-1, 0, 1], [40, 40, 70])
                  : 30;

  return (
      <motion.div
          className={`absolute top-0 left-0 ${
              isTop ? "pointer-events-auto" : "pointer-events-none"
          }`}
          style={{
            width,
            height,
            x,
            y,
            zIndex,
            transformOrigin: "top left",
            cursor: isTop ? "grab" : "default",
          }}
          initial={false}
          transition={{ type: "spring", stiffness: 360, damping: 36 }}
          drag={isTop ? "x" : false}
          dragConstraints={{ left: -1, right: 1 }}
          dragElastic={0.12}
          dragMomentum={false}
          dragPropagation={false}
          onDragStart={() => {
            if (isTop) shift.set(0);
          }}
          onDrag={(_, info) => {
            if (!isTop) return;
            const STEP = baseW + gap;
            const t = clamp(info.offset.x / STEP, -1, 1);
            shift.set(t);
          }}
          onDragEnd={isTop ? onDragEnd : undefined}
          whileDrag={isTop ? { cursor: "grabbing" } : undefined}
      >
        <div
            className="relative h-full w-full overflow-hidden rounded-[34px] bg-white shadow-[0_34px_100px_rgba(0,0,0,0.22)]"
            style={{ touchAction: "pan-y" }}
        >
          <Image
              src={item.image}
              alt={item.title}
              fill
              className="object-cover"
              priority={isTop}
          />
        </div>
      </motion.div>
  );
}