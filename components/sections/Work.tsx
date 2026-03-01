"use client";

import Image from "next/image";
import Link from "next/link";
import { useMemo, useRef, useState } from "react";
import {
  motion,
  useMotionValueEvent,
  useScroll,
  useTransform,
  type MotionValue,
} from "framer-motion";

type WorkItem = {
  title: string;
  subtitle: string;
  desc: string;
  color: string;
  image: string;
  href: string;
};

const clamp = (n: number, min: number, max: number) =>
    Math.max(min, Math.min(max, n));

export default function Work() {
  const works: WorkItem[] = useMemo(
      () => [
        {
          title: "Binghatti",
          subtitle: "Lansman",
          desc: "Binghatti Skyblade\nLansman Projesi,\nRixos Tersane",
          color: "#C41027",
          image: "/images/works/work-1.jpg",
          href: "/works/binghatti",
        },
        {
          title: "Kültür\nBakanlığı",
          subtitle: "Ödül Gecesi",
          desc: "“Umudun İzleri”\nFotoğraf Yarışması,\nRami Kütüphanesi",
          color: "#1910C4",
          image: "/images/works/work-2.jpg",
          href: "/works/kultur-bakanligi",
        },
        {
          title: "Türk\nTelekom",
          subtitle: "Sergi",
          desc: "Dijital Tasarım\nSergisi, Atatürk\nKültür Merkezi",
          color: "#BB2A06",
          image: "/images/works/work-3.jpg",
          href: "/works/turk-telekom",
        },
      ],
      []
  );

  const steps = Math.max(works.length - 1, 1);
  const rangeRef = useRef<HTMLDivElement | null>(null);

  const { scrollYProgress } = useScroll({
    target: rangeRef,
    offset: ["start start", "end start"],
  });

  const HOLD_TAIL = 0.22;

  const deckProgress = useTransform(scrollYProgress, [0, 1 - HOLD_TAIL], [0, 1], {
    clamp: true,
  });

  const [active, setActive] = useState(0);

  useMotionValueEvent(deckProgress, "change", (v) => {
    const idx = clamp(Math.round(v * steps), 0, works.length - 1);
    setActive(idx);
  });

  function scrollToIndex(idx: number) {
    if (!rangeRef.current) return;

    const rect = rangeRef.current.getBoundingClientRect();
    const startY = window.scrollY + rect.top;
    const endY = startY + rangeRef.current.offsetHeight - window.innerHeight;

    const tBase = steps === 0 ? 0 : idx / steps;
    const t = tBase * (1 - HOLD_TAIL);
    const target = startY + (endY - startY) * t;

    window.scrollTo({ top: target, behavior: "smooth" });
  }

  function goNext() {
    scrollToIndex(clamp(active + 1, 0, works.length - 1));
  }

  function goPrev() {
    scrollToIndex(clamp(active - 1, 0, works.length - 1));
  }

  const CARD_W = 987;
  const CARD_H = 565;
  const STAGE_TOP = 120;
  const rangeHeightVh = (works.length + 2) * 100;

  return (
      <section id="work" className="relative w-full bg-white">
        <div className="mx-auto w-full px-6 lg:px-[123px] py-20">
          <div className="grid gap-10 lg:grid-cols-[987px_1fr] lg:items-start">

            {/* LEFT */}
            <div className="lg:pr-24">
              <div
                  ref={rangeRef}
                  className="relative mx-auto w-full"
                  style={{ height: `${rangeHeightVh}vh` }}
              >
                <div className="sticky top-0 h-screen">
                  <div className="relative mx-auto flex h-full w-full items-center">

                    {works.map((item, i) => (
                        <DeckCard
                            key={item.title}
                            item={item}
                            index={i}
                            steps={steps}
                            progress={deckProgress}
                            cardW={CARD_W}
                            cardH={CARD_H}
                            stageTop={STAGE_TOP}
                        />
                    ))}

                    {/* Arrow controls */}
                    <div className="pointer-events-none absolute left-10 bottom-24 z-[90] flex items-center gap-3">
                      <button
                          onClick={goPrev}
                          disabled={active === 0}
                          className="pointer-events-auto h-11 w-11 rounded-full border border-black/20 text-black/60 disabled:opacity-30"
                      >
                        ↑
                      </button>
                      <button
                          onClick={goNext}
                          disabled={active === works.length - 1}
                          className="pointer-events-auto h-11 w-11 rounded-full border border-black/20 text-black/60 disabled:opacity-30"
                      >
                        ↓
                      </button>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            {/* RIGHT TITLE */}
            <div className="sticky top-[124px] ml-auto w-[260px]">
              <div className="flex gap-6">
                <div className="h-[168px] w-[3px] bg-[#C41027]" />
                <div className="text-[#C41027]" style={{ fontSize: "40px", lineHeight: 1.1, fontWeight: 500 }}>
                  Son
                  <br />
                  İşlerimiz
                </div>
              </div>
              <div className="mt-[138px]">
                <a
                  href="/works"
                  className="inline-flex items-center gap-3 text-[#C41027]"
                  style={{ fontSize: "20px", fontWeight: 500, letterSpacing: "0.02em" }}
                >
                  Tüm İşler <span>→</span>
                </a>
              </div>
            </div>

          </div>
        </div>
      </section>
  );
}

function DeckCard({
                    item,
                    index,
                    steps,
                    progress,
                    cardW,
                    cardH,
                    stageTop,
                  }: {
  item: WorkItem;
  index: number;
  steps: number;
  progress: MotionValue<number>;
  cardW: number;
  cardH: number;
  stageTop: number;
}) {
  const GAP = 140;
  const PEEK = 160;

  const baseY =
      index === 0 ? 0 : cardH + GAP + (index - 1) * (PEEK + GAP);

  const segStart = steps === 0 ? 0 : (index - 1) / steps;
  const segEnd = steps === 0 ? 0 : index / steps;

  const y =
      index === 0
          ? useTransform(progress, [0, 1], [0, 0])
          : useTransform(progress, [0, segStart, segEnd, 1], [baseY, baseY, 0, 0]);

  const zIndex = 300 + index;

  return (
      <motion.div
          className="absolute top-0"
          style={{
            zIndex,
            y,
            top: stageTop,
            left: 0,
            x: 0,
            width: cardW,
            filter: "drop-shadow(0 40px 80px rgba(0,0,0,0.18))",
          }}
      >
        <WorkCard item={item} cardW={cardW} cardH={cardH} />
      </motion.div>
  );
}

function WorkCard({
                    item,
                    cardW,
                    cardH,
                  }: {
  item: WorkItem;
  cardW: number;
  cardH: number;
}) {
  return (
      <div
          className="relative overflow-hidden rounded-[20px] border border-white/90"
          style={{
            backgroundColor: item.color,
            width: cardW,
            height: cardH,
          }}
      >
        <div className="absolute inset-0 px-[64px] py-[52px]">
          <div className="grid h-full gap-12 md:grid-cols-[601px_minmax(0,1fr)] md:items-start">

            {/* LEFT IMAGE */}
            <div className="relative h-[462px] w-[601px] overflow-hidden rounded-[21px] flex-none">
              <Image src={item.image} alt={item.title} fill className="object-cover" />
            </div>

            {/* RIGHT TEXT */}
            <div className="flex h-full min-w-0 flex-col text-white pr-10">

              {/* FIXED TITLE */}
              <h3
                className="font-semibold tracking-tight text-white"
                style={{
                  fontSize: "48px",
                  lineHeight: 1.1,
                }}
              >
                {item.title}
              </h3>

              <div className="mt-4 text-[18px] font-medium leading-7 text-white/85">
                {item.subtitle}
              </div>

              <p className="mt-10 text-[18px] leading-8 text-white/85 whitespace-pre-line">
                {item.desc}
              </p>

              <div className="mt-auto pt-14">
                <Link
                    href={item.href}
                    className="inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/55 text-white/90 hover:bg-white/10"
                >
                  →
                </Link>
              </div>

            </div>
          </div>
        </div>
      </div>
  );
}