class custom_inputmask {
    constructor(_element, nullChar, sepChar) {
        this._input = null;
        this._shadow = null;
        this._months = null;
        this._currentDate = new Date();
        this._sepChar = sepChar;
        this._nullChar = nullChar;
        // this._init(_element);
    }

    // _init(_element) {
    //     this._input = document.getElementById(_element);
    //     if(this._input.getAttribute('data-date')){
    //         console.log("set date mode!");
    //         this._shadow = [null, null, this._sepChar, null, null, this._sepChar, null, null, null, null];
    //         this._months = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    //         this._populateDate();
    //     }else if(this._input) {
    //         this._shadow = [null, null, this._sepChar, null, null, this._sepChar, null, null, null, null];
    //         this._months = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    //         this._Events();
    //         this._render();
    //     } else {
    //         console.log("can't find tag");
    //     }
    // }

    _Events() {
        this._input.onclick = () => {
            this._input.selectionStart = 0;
            this._input.selectionEnd = 0;
            this._input.onclick = null;
        };
        this._input.onkeydown = key => this._onKeyPress(key);
    }

    _onKeyPress(key) {
        if (new RegExp(/^\d+$/).test(key.key)) {
            this._digitType(key.key, this._input.selectionStart);
            key.preventDefault();
        } else if (key.key === 'Backspace') {
            this._removeDigit(this._input.selectionStart - 1);
            key.preventDefault();
        } else if (key.key !== "ArrowLeft" && key.key !== "ArrowRight" && key.key !== "Tab" && key.key !== "F5") {
            key.preventDefault();
        }
    }

    _digitType(key, index) {
        if (this._shadow[index] === null || this._shadow[index] === this._sepChar) {
            if (index === 0 && parseInt(key) < 4) {
                this._validator(key, index);
            } else if (index === 1) {
                if (this._shadow[0] < 3) {
                    this._validator(key, index);
                } else if (this._shadow[0] === 3 && parseInt(key) < 2) {
                    this._validator(key, index);
                }
            } else if (index === 2) {
                console.log("index ", index);
                this._input.selectionStart = index + 1;
                this._input.selectionEnd = index + 1;
                this._digitType(key, this._input.selectionStart);
            }else if(key === 2 || this._shadow[index] === this._sepChar){
                console.log("same char");
            } else if (index === 3 && parseInt(key) < 2) {
                console.log("index ", index);
                this._validator(key, index);
            } else if (index === 4) {
                if (this._shadow[3] > 0 && parseInt(key) < 3) {
                    this._validator(key, index);
                } else if (this._shadow[3] === 0) {
                    this._validator(key, index);
                }
            } else if (index === 5) {
                this._input.selectionStart = index + 1;
                this._input.selectionEnd = index + 1;
                this._digitType(key, this._input.selectionStart);
            } else if (index === 6) {
                this._validator(key, index);
            } else if (index === 7) {
                this._validator(key, index);
            } else if (index === 8) {
                this._validator(key, index);
            } else if (index === 9) {
                this._validator(key, index);
            }
        }
    }

    _validator(key, index) {
        this._shadow[index] = parseInt(key);
        var currentBlock = this._getCurrentBlock(index);
        var _dd = null;
        var _mm = null;
        var _yy = null;
        if (this._shadow[0] !== null && this._shadow[1] !== null) {
            _dd = this._shadow[0] * 10 + this._shadow[1];
        }
        if (this._shadow[3] !== null && this._shadow[4] !== null) {
            _mm = this._shadow[3] * 10 + this._shadow[4];
        }
        if (this._shadow[6] !== null && this._shadow[7] !== null && this._shadow[8] !== null && this._shadow[9] !== null) {
            _yy = parseInt(this._shadow.slice(6, 10).join(''));
        }

        if (currentBlock === 'day') {
            if (_dd) {
                if (_dd === 29 && _mm === 2) {
                    if (_yy && _yy % 4 === 0) {
                        this._render(index + 1);
                    } else if (!_yy) {
                        this._render(index + 1);
                    } else {
                        this._shadow[index] = null;
                    }
                } else if (_mm && _dd <= this._months[_mm - 1]) {
                    this._render(index + 1);
                } else if (_mm && _dd > this._months[_mm - 1]) {
                    this._shadow[index] = null;
                } else {
                    this._render(index + 1);
                }
            } else {
                this._render(index + 1);
            }
        } else if (currentBlock === 'month') {
            if (_mm) {
                if (_dd === 29 && _mm === 2) {
                    if (_yy && _yy % 4 === 0) {
                        this._render(index + 1);
                    } else if (!_yy) {
                        this._render(index + 1);
                    } else {
                        this._shadow[index] = null;
                    }
                } else if (_dd && _dd <= this._months[_mm - 1]) {
                    this._render(index + 1);
                } else if (_dd && _dd > this._months[_mm - 1]) {
                    this._shadow[index] = null;
                }
            } else {
                this._render(index + 1);
            }
        } else if (currentBlock === 'year') {
            if (_yy) {
                if (_dd === 29 && _mm === 2 && _yy % 4 === 0) {
                    this._render(index + 1);
                } else if (_dd === 29 && _mm === 2 && _yy % 4 !== 0) {
                    this._shadow[index] = null;
                } else if (this._currentDate < new Date(String(_mm) + '-' + String(_dd) + '-' + String(_yy))) {
                    alert('ထည့်သွင်းသောရက်စွဲမှားနေသည်။');
                    this._shadow[index] = null;
                } else {
                    this._render(index + 1);
                }
            } else {
                this._render(index + 1);
            }
        }
    }

    _getCurrentBlock(index) {
        if (index >= 0 && index < 3) {
            return "day";
        } else if (index >= 3 && index < 5) {
            return "month";
        } else if (index > 5) {
            return "year";
        }
    }

    _removeDigit(index) {
        if (index >= 0 && this._shadow[index] !== this._sepChar) {
            this._shadow[index] = null;
            this._render(index);
        } else if (this._shadow[index] === this._sepChar) {
            this._removeDigit(index - 1);
        }
    }

    _render(index) {
        this._input.value = null;
        this._shadow.map(char => char === null ? this._input.value += this._nullChar : this._input.value += char)
        this._input.selectionStart = index;
        this._input.selectionEnd = index;
        // var dArr = value.split('-').join('').split('').map( (char, key) => {
        //     console.log(key, Number(char));
        //     this._digitType(Number(char), key);
        // }
    }

    _populateDate(){
        let dateValue = this._input.getAttribute('data-date');
        dateValue.split('').map( (index, key) => {
            if(index !== '-'){
                this._digitType(key, Number(index));
            }else{
                console.log(index);
                return ;
            }
        });
    }
}
