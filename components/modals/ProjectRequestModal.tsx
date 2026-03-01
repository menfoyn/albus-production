"use client";

import { useEffect } from "react";
import { AnimatePresence, motion } from "framer-motion";

type Props = {
    open: boolean;
    onClose: () => void;
};

export default function ProjectRequestModal({ open, onClose }: Props) {
    useEffect(() => {
        if (!open) return;

        const onKeyDown = (e: KeyboardEvent) => {
            if (e.key === "Escape") onClose();
        };

        window.addEventListener("keydown", onKeyDown);
        return () => window.removeEventListener("keydown", onKeyDown);
    }, [open, onClose]);

    // Şimdilik DB yok: mailto ile gönderelim (sonra API/DB'ye çeviririz)
    function onSubmit(e: React.FormEvent<HTMLFormElement>) {
        e.preventDefault();

        const form = new FormData(e.currentTarget);
        const name = String(form.get("name") || "");
        const brand = String(form.get("brand") || "");
        const phone = String(form.get("phone") || "");
        const email = String(form.get("email") || "");
        const about = String(form.get("about") || "");

        const subject = encodeURIComponent("Albus Production - Proje Talebi");
        const body = encodeURIComponent(
            `İsim Soyisim: ${name}\nMarka: ${brand}\nTelefon: ${phone}\nE-posta: ${email}\n\nProje Hakkında:\n${about}`
        );

        window.location.href = `mailto:info@albusproduction.com?subject=${subject}&body=${body}`;
    }

    return (
        <AnimatePresence>
            {open && (
                <motion.div
                    className="fixed inset-0 z-[999] flex items-center justify-center px-4"
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                >
                    {/* overlay */}
                    <button
                        aria-label="Close"
                        onClick={onClose}
                        className="absolute inset-0 bg-black/60"
                    />

                    {/* modal */}
                    <motion.div
                        initial={{ opacity: 0, scale: 0.98, y: 18 }}
                        animate={{ opacity: 1, scale: 1, y: 0 }}
                        exit={{ opacity: 0, scale: 0.98, y: 18 }}
                        transition={{ duration: 0.22, ease: "easeOut" }}
                        className="relative w-full max-w-[572px] rounded-[18px] bg-[#120522] px-10 py-10 text-white shadow-2xl"
                    >
                        {/* close X */}
                        <button
                            type="button"
                            onClick={onClose}
                            className="absolute right-6 top-6 text-white/70 hover:text-white"
                            aria-label="Close modal"
                        >
                            ✕
                        </button>

                        <div className="text-white/70 text-sm leading-6">
                            Sizinle İletişime Geçmemiz için
                            <br />
                            lütfen Formu Doldurun.
                        </div>

                        <form onSubmit={onSubmit} className="mt-10 space-y-7">
                            <Input name="name" placeholder="İsim Soyisim" />
                            <Input name="brand" placeholder="Markanız" />
                            <Input name="phone" placeholder="İletişim Numarası" />
                            <Input name="email" placeholder="Mail Adresiniz" type="email" />
                            <Input name="about" placeholder="Proje Hakkında" />

                            <div className="pt-4 flex justify-end">
                                <button
                                    type="submit"
                                    className="inline-flex items-center gap-2 text-white/70 hover:text-white"
                                >
                                    Gönder <span>↘</span>
                                </button>
                            </div>
                        </form>
                    </motion.div>
                </motion.div>
            )}
        </AnimatePresence>
    );
}

function Input({
                   name,
                   placeholder,
                   type = "text",
               }: {
    name: string;
    placeholder: string;
    type?: string;
}) {
    return (
        <div className="relative">
            <input
                name={name}
                type={type}
                placeholder={placeholder}
                required
                className="w-full bg-transparent pb-3 text-sm text-white/80 placeholder:text-white/30 outline-none"
            />
            <div className="h-px w-full bg-white/20" />
        </div>
    );
}