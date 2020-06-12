"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
Object.defineProperty(exports, "__esModule", { value: true });
var graphql_1 = require("graphql");
var graphql_language_service_interface_1 = require("graphql-language-service-interface");
var schemaLoader_1 = require("./schemaLoader");
var LanguageService = (function () {
    function LanguageService(_a) {
        var _this = this;
        var parser = _a.parser, schemaLoader = _a.schemaLoader, schemaBuilder = _a.schemaBuilder, schemaConfig = _a.schemaConfig, rawSchema = _a.rawSchema, parseOptions = _a.parseOptions;
        this._parser = graphql_1.parse;
        this._schema = null;
        this._schemaResponse = null;
        this._schemaLoader = schemaLoader_1.defaultSchemaLoader;
        this._schemaBuilder = schemaLoader_1.defaultSchemaBuilder;
        this._rawSchema = null;
        this._parseOptions = undefined;
        this.getCompletion = function (_uri, documentText, position) { return __awaiter(_this, void 0, void 0, function () { var _a; return __generator(this, function (_b) {
            switch (_b.label) {
                case 0:
                    _a = graphql_language_service_interface_1.getAutocompleteSuggestions;
                    return [4, this.getSchema()];
                case 1: return [2, _a.apply(void 0, [_b.sent(), documentText, position])];
            }
        }); }); };
        this.getDiagnostics = function (_uri, documentText, customRules) { return __awaiter(_this, void 0, void 0, function () {
            var _a, _b;
            return __generator(this, function (_c) {
                switch (_c.label) {
                    case 0:
                        if (!documentText || documentText.length < 1) {
                            return [2, []];
                        }
                        _a = graphql_language_service_interface_1.getDiagnostics;
                        _b = [documentText];
                        return [4, this.getSchema()];
                    case 1: return [2, _a.apply(void 0, _b.concat([_c.sent(), customRules]))];
                }
            });
        }); };
        this.getHover = function (_uri, documentText, position) { return __awaiter(_this, void 0, void 0, function () { var _a; return __generator(this, function (_b) {
            switch (_b.label) {
                case 0:
                    _a = graphql_language_service_interface_1.getHoverInformation;
                    return [4, this.getSchema()];
                case 1: return [2, _a.apply(void 0, [_b.sent(), documentText, position])];
            }
        }); }); };
        this._schemaConfig = schemaConfig;
        if (parser) {
            this._parser = parser;
        }
        if (schemaLoader) {
            this._schemaLoader = schemaLoader;
        }
        if (schemaBuilder) {
            this._schemaBuilder = schemaBuilder;
        }
        if (rawSchema) {
            this._rawSchema = rawSchema;
        }
        if (parseOptions) {
            this._parseOptions = parseOptions;
        }
    }
    Object.defineProperty(LanguageService.prototype, "schema", {
        get: function () {
            return this._schema;
        },
        enumerable: true,
        configurable: true
    });
    LanguageService.prototype.getSchema = function () {
        return __awaiter(this, void 0, void 0, function () {
            return __generator(this, function (_a) {
                if (this.schema) {
                    return [2, this.schema];
                }
                return [2, this.loadSchema()];
            });
        });
    };
    LanguageService.prototype.setSchema = function (schema) {
        return __awaiter(this, void 0, void 0, function () {
            return __generator(this, function (_a) {
                this._rawSchema = schema;
                return [2, this.loadSchema()];
            });
        });
    };
    LanguageService.prototype.getSchemaResponse = function () {
        return __awaiter(this, void 0, void 0, function () {
            return __generator(this, function (_a) {
                if (this._schemaResponse) {
                    return [2, this._schemaResponse];
                }
                return [2, this.loadSchemaResponse()];
            });
        });
    };
    LanguageService.prototype.loadSchemaResponse = function () {
        var _a;
        return __awaiter(this, void 0, void 0, function () {
            var _b;
            return __generator(this, function (_c) {
                switch (_c.label) {
                    case 0:
                        if (this._rawSchema) {
                            return [2, typeof this._rawSchema === 'string'
                                    ? this.parse(this._rawSchema)
                                    : this._rawSchema];
                        }
                        if (!((_a = this._schemaConfig) === null || _a === void 0 ? void 0 : _a.uri)) {
                            throw new Error('uri missing');
                        }
                        _b = this;
                        return [4, this._schemaLoader(this._schemaConfig)];
                    case 1:
                        _b._schemaResponse = (_c.sent());
                        return [2, this._schemaResponse];
                }
            });
        });
    };
    LanguageService.prototype.loadSchema = function () {
        return __awaiter(this, void 0, void 0, function () {
            var schemaResponse;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0: return [4, this.loadSchemaResponse()];
                    case 1:
                        schemaResponse = _a.sent();
                        this._schema = this._schemaBuilder(schemaResponse, this._schemaConfig.buildSchemaOptions);
                        return [2, this._schema];
                }
            });
        });
    };
    LanguageService.prototype.parse = function (text, options) {
        return __awaiter(this, void 0, void 0, function () {
            return __generator(this, function (_a) {
                return [2, this._parser(text, options || this._parseOptions)];
            });
        });
    };
    return LanguageService;
}());
exports.LanguageService = LanguageService;
//# sourceMappingURL=LanguageService.js.map