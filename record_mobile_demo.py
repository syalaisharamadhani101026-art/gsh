import time
import os
import shutil
from playwright.sync_api import sync_playwright

def record_walkthrough():
    temp_dir = os.path.abspath("temp_video_rec")
    os.makedirs(temp_dir, exist_ok=True)
    out_dir = os.path.abspath("public/videos")
    os.makedirs(out_dir, exist_ok=True)

    print("Launching Chromium via Playwright...")
    with sync_playwright() as p:
        browser = p.chromium.launch(
            executable_path=r"C:\Program Files\Google\Chrome\Application\chrome.exe",
            headless=True,
            args=["--hide-scrollbars", "--disable-gpu", "--no-sandbox"]
        )

        # Emulate iPhone 14 Pro
        context = browser.new_context(
            viewport={"width": 430, "height": 932},
            device_scale_factor=2,
            is_mobile=True,
            has_touch=True,
            record_video_dir=temp_dir,
            record_video_size={"width": 430, "height": 932},
            user_agent="Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1"
        )

        page = context.new_page()

        print("1. Opening Web Customer Mobile (Warm Cream & Gold Theme)...")
        page.goto("http://localhost/gsh/public/mobile", wait_until="load")
        time.sleep(2.5)

        # 2. Showcase the Opening Video Header on Dashboard
        print("2. Interacting with Dashboard Opening Video Reel...")
        # Toggle audio on video
        dash_audio_btn = page.locator('#dashVideoAudioBtn').first
        if dash_audio_btn.is_visible():
            dash_audio_btn.click()
            time.sleep(1.5)
            dash_audio_btn.click()
            time.sleep(1.0)

        # 3. Open Fullscreen Cinematic Hotel Video Overlay
        print("3. Opening Fullscreen Cinematic Drone Video Overlay...")
        open_video_btn = page.locator('button[onclick="openMobileIntro(true)"]').first
        if open_video_btn.is_visible():
            open_video_btn.click()
            time.sleep(3.5) # Let video play in full cinematic mode
            # Click Lewati (Skip)
            page.locator('button[onclick="closeMobileIntro()"]').first.click()
            time.sleep(1.5)

        # 4. Select VIP Gold Member Siti Rahma
        print("4. Selecting VIP Gold Member Siti Rahma...")
        demo_btn = page.locator('a[href*="guest_id=2"]').first
        if demo_btn.is_visible():
            demo_btn.click()
            page.wait_for_load_state("load")
        else:
            page.goto("http://localhost/gsh/public/mobile?guest_id=2", wait_until="load")
        time.sleep(2.5)

        # Smooth scroll through home dashboard
        print("5. Exploring VIP Dashboard (Opening Video + Gold Member Card)...")
        page.mouse.wheel(0, 280)
        time.sleep(1.5)
        page.mouse.wheel(0, 320)
        time.sleep(2.0)
        page.mouse.wheel(0, -600)
        time.sleep(1.5)

        # Switch to Kartu VIP tab
        print("6. Switching to Kartu VIP tab...")
        page.locator("#nav-btn-kartu").click()
        time.sleep(3.0)

        # Switch to Katalog Hadiah tab
        print("7. Switching to Katalog Hadiah tab...")
        page.locator("#nav-btn-katalog").click()
        time.sleep(2.0)

        # Filter categories
        print("Filtering 100 Pts rewards...")
        page.locator("#cat-pill-100").click()
        time.sleep(1.5)

        print("Filtering 500 Pts rewards...")
        page.locator("#cat-pill-500").click()
        time.sleep(1.5)

        print("Filtering All rewards...")
        page.locator("#cat-pill-all").click()
        time.sleep(1.5)

        # Preview redeem modal on first affordable item
        redeem_btn = page.locator('.catalog-item button:has-text("Tukar Sekarang")').first
        if redeem_btn.is_visible():
            print("Opening Redeem Modal...")
            redeem_btn.click()
            time.sleep(2.5)
            # Close modal
            page.locator('#redeemModal button:has-text("Batal")').click()
            time.sleep(1.0)

        # Switch to Riwayat tab
        print("8. Switching to Riwayat tab...")
        page.locator("#nav-btn-riwayat").click()
        time.sleep(2.0)
        page.mouse.wheel(0, 200)
        time.sleep(1.5)

        # Switch to Voucher Saya subtab
        print("Viewing Voucher Saya subtab...")
        page.locator("#btnSubVouchers").click()
        time.sleep(2.0)

        # Click Salin button to show golden toast
        copy_btn = page.locator('#subTabVouchers button:has-text("Salin")').first
        if copy_btn.is_visible():
            copy_btn.click()
            time.sleep(2.0)

        # Switch to Simulasi tab
        print("9. Switching to Simulasi tab...")
        page.locator("#nav-btn-simulasi").click()
        time.sleep(1.5)

        # Change room selection and nights
        page.locator("#simRoomType").select_option("30")
        page.locator("#simNights").fill("5")
        page.evaluate("calculatePoints()")
        time.sleep(1.5)

        # Fill banquet revenue
        page.locator("#simBanquet").fill("50000000")
        page.evaluate("calculatePoints()")
        time.sleep(2.5)

        # Scroll down to concierge
        page.mouse.wheel(0, 350)
        time.sleep(2.0)
        page.mouse.wheel(0, -350)
        time.sleep(1.0)

        # Switch VIP Profile to Platinum Member Hendra Wijaya
        print("10. Switching VIP Profile to Platinum Member Hendra Wijaya...")
        page.locator('button[onclick="openSearchModal()"]').first.click()
        time.sleep(1.5)

        plat_link = page.locator('a[href*="guest_id=3"]').first
        if plat_link.is_visible():
            plat_link.click()
            page.wait_for_load_state("load")
        else:
            page.goto("http://localhost/gsh/public/mobile?guest_id=3", wait_until="load")
        time.sleep(3.5)

        print("Recording completed successfully!")
        page.close()
        context.close()
        browser.close()

    # Move recorded video to public/videos/rekam-layar-mobile.webm
    target_webm = os.path.join(out_dir, "rekam-layar-mobile.webm")
    rec_files = [os.path.join(temp_dir, f) for f in os.listdir(temp_dir) if f.endswith(".webm")]
    if rec_files:
        src = max(rec_files, key=os.path.getctime)
        shutil.copy2(src, target_webm)
        print(f"Saved video to: {target_webm} (Size: {os.path.getsize(target_webm)} bytes)")

        # Convert to MP4 using imageio_ffmpeg
        target_mp4 = os.path.join(out_dir, "rekam-layar-mobile.mp4")
        try:
            import imageio_ffmpeg
            ffmpeg_exe = imageio_ffmpeg.get_ffmpeg_exe()
            import subprocess
            print("Converting to MP4 via ffmpeg...")
            subprocess.run([
                ffmpeg_exe, "-y",
                "-i", target_webm,
                "-c:v", "libx264",
                "-pix_fmt", "yuv420p",
                "-crf", "22",
                "-preset", "fast",
                target_mp4
            ], check=True)
            print(f"Saved MP4 to: {target_mp4} (Size: {os.path.getsize(target_mp4)} bytes)")
        except Exception as e:
            print(f"MP4 conversion skipped or failed: {e}")

if __name__ == "__main__":
    record_walkthrough()
