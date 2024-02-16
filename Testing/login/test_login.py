import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time

def login(username, password):
    driver = webdriver.Firefox()
    try:
        driver.get('https://192.168.9.78/')

        driver.maximize_window()
        time.sleep(5)

        usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(username)
        pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(password)

        btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
        btn.click()

        element = WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//img[contains(@alt,'Logo Tabantaj')]"))
        )
        return True
    except TimeoutException:
        return False
    finally:
        driver.quit()

def test_login():
    username = "admin@admin.com"
    password = "#S3cur3P4$$w0Rd!"

    result = login(username, password)
    assert result, f"Login {'successful' if result else 'failed'}"

if __name__ == "__main__":
    pytest.main(["-v", "-s"])


