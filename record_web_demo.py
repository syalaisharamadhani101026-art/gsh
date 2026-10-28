import time
import os
import shutil
import subprocess
from playwright.sync_api import sync_playwright
import imageio_ffmpeg

def record_web_walkthrough():
    temp_dir = os.path.abspath("temp_web_video_rec")
    os.makedirs(temp_dir, exist_ok=True)
    out_dir = os.path.abspath("public/videos")
    os.makedirs(out_dir, exist_ok=True)

    print("Launching Chrome for Desktop Web Walkthrough Recording...")
    with sync_playwright() as p:
        browser = p.chromium.launch(
            executable_path=r"C:\Program Files\Google\Chrome\Application\chrome.exe",
            headless=True,
            args=["--hide-scrollbars", "--disable-gpu", "--no-sandbox"]
        )

        # Desktop 1080p-scaled viewport (1366x768 or 1440x900)
        context = browser.new_context(
            viewport={"width": 1440, "height": 900},
            device_scale_factor=1,
            is_mobile=False,
            record_video_dir=temp_dir,
            record_video_size={"width": 1440, "height": 900},
            user_agent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36"
        )

        page = context.new_page()

        print("1. Opening Desktop Web Portal (Senyum Stay Priority)...")
        page.goto("http://localhost/gsh/public/cek-poin", wait_until="load")
        time.sleep(2.0)

        # 2. Showcase Cinematic Drone Video Overlay on first visit
        print("2. Cinematic Drone Video Overlay playing...")
        audio_btn = page.locator('#audio-toggle-btn').first
        if audio_btn.is_visible():
            audio_btn.click()
            time.sleep(1.0)
            audio_btn.click()
            time.sleep(1.0)

        # Dismiss Drone Intro
        print("3. Entering Member Priority Portal...")
        enter_btn = page.locator('button[onclick="closeDroneIntro()"]').first
        if enter_btn.is_visible():
            enter_btn.click()
        else:
            page.evaluate("if (typeof closeDroneIntro === 'function') closeDroneIntro();")
        time.sleep(2.5)

        # 4. Highlight 80% Full HD Hero & 3 Mini Highlights Card
        print("4. Showcasing Full HD 80% Building Background & Readable Stats Card...")
        time.sleep(2.0)

        # Click demo guest button: Siti Rahma (Gold 2.500)
        print("5. Selecting Demo Guest Siti Rahma (Gold)...")
        siti_btn = page.locator('button:has-text("Siti (Gold 2.500)")').first
        if siti_btn.is_visible():
            siti_btn.click()
            time.sleep(1.5)

        # Click submit search form
        print("6. Submitting Cek Status & Poin Member...")
        submit_btn = page.locator('#heroSearchForm button[type="submit"]').first
        if submit_btn.is_visible():
            submit_btn.click()
            page.wait_for_load_state("load")
        else:
            page.goto("http://localhost/gsh/public/cek-poin?name=Siti+Rahma&phone=08198765432#member-hub", wait_until="load")
        time.sleep(3.0)

        # 7. Explore Member Hub Dashboard
        print("7. Exploring VIP Member Hub (Gold Card, Points & Tier Progress)...")
        page.mouse.wheel(0, 450)
        time.sleep(2.5)

        # Copy Voucher Code if visible
        copy_voucher = page.locator('button:has-text("Salin")').first
        if copy_voucher.is_visible():
            copy_voucher.click()
            time.sleep(1.5)

        # 8. Scroll to Catalog Hadiah
        print("8. Navigating to Katalog Hadiah...")
        page.mouse.wheel(0, 600)
        time.sleep(2.0)

        # Filter categories in desktop catalog if present
        for filter_id in ['cat-filter-100', 'cat-filter-500', 'cat-filter-all']:
            filt = page.locator(f'#{filter_id}').first
            if filt.is_visible():
                filt.click()
                time.sleep(1.5)

        # 9. Scroll to Kalkulator Simulasi Poin
        print("9. Interacting with Kalkulator Simulasi Poin...")
        page.mouse.wheel(0, 650)
        time.sleep(2.0)

        # Change room or nights if elements exist
        sim_room = page.locator('#simRoom').first
        if sim_room.is_visible():
            sim_room.select_option(index=2)
            time.sleep(1.0)

        sim_nights = page.locator('#simNights').first
        if sim_nights.is_visible():
            sim_nights.fill("4")
            time.sleep(1.0)

        sim_banquet = page.locator('#simBanquet').first
        if sim_banquet.is_visible():
            sim_banquet.fill("30000000")
            time.sleep(1.5)

        # 10. Scroll to Concierge & WhatsApp Section
        print("10. Showcasing Official Concierge & WhatsApp Integration...")
        page.mouse.wheel(0, 700)
        time.sleep(2.5)

        # Smooth scroll back to top
        print("11. Scrolling back to top hero...")
        page.mouse.wheel(0, -2500)
        time.sleep(2.5)

        print("Desktop Web Recording completed successfully!")
        page.close()
        context.close()
        browser.close()

    # Move recorded video to public/videos/rekam-layar-web.webm
    target_webm = os.path.join(out_dir, "rekam-layar-web.webm")
    rec_files = [os.path.join(temp_dir, f) for f in os.listdir(temp_dir) if f.endswith(".webm")]
    if rec_files:
        src = max(rec_files, key=os.path.getctime)
        shutil.copy2(src, target_webm)
        print(f"Saved Web video to: {target_webm} (Size: {os.path.getsize(target_webm)} bytes)")

        # Convert to MP4
        target_mp4 = os.path.join(out_dir, "rekam-layar-web.mp4")
        try:
            ffmpeg_exe = imageio_ffmpeg.get_ffmpeg_exe()
            print("Converting Web video to MP4 via ffmpeg...")
            subprocess.run([
                ffmpeg_exe, "-y",
                "-i", target_webm,
                "-c:v", "libx264",
                "-pix_fmt", "yuv420p",
                "-crf", "22",
                "-preset", "fast",
                target_mp4
            ], check=True)
            print(f"Saved Web MP4 to: {target_mp4} (Size: {os.path.getsize(target_mp4)} bytes)")
        except Exception as e:
            print(f"MP4 conversion failed: {e}")

if __name__ == "__main__":
    record_web_walkthrough()
